<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class SpamProtectionService
{
    /**
     * Minimum time in seconds a human needs to fill out the form.
     */
    protected const MIN_FORM_TIME_SECONDS = 3;

    /**
     * Maximum valid time in seconds for a form token (24 hours).
     */
    protected const MAX_FORM_TIME_SECONDS = 86400;

    /**
     * Honeypot field names to watch.
     */
    protected const HONEYPOT_FIELDS = [
        '_hp_website',
        '_hp_company',
        '_hp_fax_check',
    ];

    /**
     * Known spam words and patterns frequently used by bots.
     */
    protected const SPAM_KEYWORDS = [
        'crypto airdrop',
        'free bitcoin',
        'casino online',
        'viagra',
        'cialis',
        'seo ranking service',
        'backlink package',
        't.me/',
        'telegram.me/',
        'whatsapp://',
        'bit.ly/',
        'tinyurl.com/',
        'immenseignite.info',
    ];

    /**
     * Generate an encrypted form security token with current timestamp and signature.
     */
    public function generateToken(): string
    {
        $payload = [
            'ts' => time(),
            'ip' => request()->ip(),
            'salt' => Str::random(16),
        ];

        return Crypt::encryptString(json_encode($payload));
    }

    /**
     * Get the dynamic client-side interaction token expected from real browser events.
     */
    public function getJsExpectedToken(): string
    {
        return hash_hmac('sha256', 'ishraq_antispam_' . date('Y-m-d'), (string) config('app.key'));
    }

    /**
     * Verify the JavaScript human interaction token.
     */
    public function verifyJsToken(?string $token): bool
    {
        if (empty($token)) {
            return false;
        }

        $today = hash_hmac('sha256', 'ishraq_antispam_' . date('Y-m-d'), (string) config('app.key'));
        $yesterday = hash_hmac('sha256', 'ishraq_antispam_' . date('Y-m-d', strtotime('-1 day')), (string) config('app.key'));

        return hash_equals($today, $token) || hash_equals($yesterday, $token);
    }

    /**
     * Determine if the incoming request is considered spam or bot activity.
     */
    public function isSpam(Request $request, array $options = []): bool
    {
        $minSeconds = $options['min_seconds'] ?? self::MIN_FORM_TIME_SECONDS;
        $requireJsToken = $options['require_js'] ?? true;

        // 1. Check Honeypot Fields (Bots blindly fill hidden inputs)
        foreach (self::HONEYPOT_FIELDS as $field) {
            if ($request->filled($field)) {
                $this->logSpam($request, 'Honeypot field filled: ' . $field);
                return true;
            }
        }

        // 2. Check Submission Speed / Timestamp Token
        $token = $request->input('_form_submission_token');
        if (empty($token)) {
            $this->logSpam($request, 'Missing form submission token');
            return true;
        }

        try {
            $decrypted = json_decode(Crypt::decryptString($token), true);
            if (!is_array($decrypted) || !isset($decrypted['ts'])) {
                $this->logSpam($request, 'Malformed form submission token');
                return true;
            }

            $elapsed = time() - (int) $decrypted['ts'];

            // If submitted faster than human threshold
            if ($elapsed < $minSeconds) {
                $this->logSpam($request, "Submission too fast ({$elapsed}s < {$minSeconds}s)");
                return true;
            }

            // If token has expired
            if ($elapsed > self::MAX_FORM_TIME_SECONDS) {
                $this->logSpam($request, "Form token expired ({$elapsed}s)");
                return true;
            }
        } catch (\Throwable $e) {
            $this->logSpam($request, 'Invalid form token decryption: ' . $e->getMessage());
            return true;
        }

        // 3. Check JavaScript Interaction Token
        if ($requireJsToken) {
            $jsToken = $request->input('_js_interaction_token');

            if (!$this->verifyJsToken($jsToken)) {
                $this->logSpam($request, 'Missing or invalid JS interaction token (likely automated headless bot/cURL)');
                return true;
            }
        }

        // 4. Check Content Heuristics & Disposable Spam Domains
        $allText = strtolower(implode(' ', array_filter([
            $request->input('name'),
            $request->input('full_name'),
            $request->input('client_name'),
            $request->input('email'),
            $request->input('message'),
            $request->input('details'),
            $request->input('testimonial'),
        ])));

        foreach (self::SPAM_KEYWORDS as $keyword) {
            if (str_contains($allText, $keyword)) {
                $this->logSpam($request, "Spam keyword detected: '{$keyword}'");
                return true;
            }
        }

        // 5. Check Duplicate Message Blasting (same content/email within 10 minutes)
        $email = $request->input('email');
        if ($email) {
            $contentHash = md5($email . '_' . $request->input('message', '') . '_' . $request->input('details', ''));
            $cacheKey = 'spam_dup_' . $contentHash;

            if (Cache::has($cacheKey)) {
                $this->logSpam($request, 'Duplicate submission blast detected');
                return true;
            }

            Cache::put($cacheKey, true, now()->addMinutes(10));
        }

        return false;
    }

    /**
     * Log detected spam attempt for auditing and monitoring.
     */
    public function logSpam(Request $request, string $reason): void
    {
        Log::channel('single')->warning('[AntiSpam] Blocked bot/spam submission', [
            'reason' => $reason,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'url' => $request->fullUrl(),
            'inputs' => $request->except(['_token', '_form_submission_token', '_js_interaction_token', 'attachment', 'cv']),
        ]);
    }
}
