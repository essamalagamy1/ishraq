<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\DesignRequest;
use App\Models\JobApplication;
use App\Models\Testimonial;
use App\Services\SpamProtectionService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AntiSpamProtectionTest extends TestCase
{
    use RefreshDatabase;

    protected function createValidTokens(): array
    {
        $spamService = app(SpamProtectionService::class);
        $payload = [
            'ts' => time() - 5,
            'ip' => '127.0.0.1',
            'salt' => 'valid_salt_' . uniqid(),
        ];

        return [
            '_form_submission_token' => Crypt::encryptString(json_encode($payload)),
            '_js_interaction_token' => $spamService->getJsExpectedToken(),
            '_hp_website' => '',
            '_hp_company' => '',
            '_hp_fax_check' => '',
        ];
    }

    public function test_bot_with_honeypot_field_is_blocked_without_saving_to_database(): void
    {
        $tokens = $this->createValidTokens();
        $tokens['_hp_website'] = 'http://spam-link.com'; // Honeypot filled!

        $response = $this->post(route('contact.store'), array_merge([
            'name' => 'Bot Crawler',
            'email' => 'bot@automated-crawler.com',
            'message' => 'Hello, I want to sell you backlinks.',
        ], $tokens));

        $response->assertRedirect();
        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'bot@automated-crawler.com',
        ]);
    }

    public function test_bot_without_token_is_blocked(): void
    {
        $response = $this->post(route('contact.store'), [
            'name' => 'Carloskap',
            'email' => 'luna0485@hotmail.com',
            'message' => 'Automated curl script payload',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'luna0485@hotmail.com',
        ]);
    }

    public function test_submission_faster_than_threshold_is_blocked(): void
    {
        $spamService = app(SpamProtectionService::class);
        $payload = [
            'ts' => time(),
            'ip' => '127.0.0.1',
            'salt' => 'test',
        ];
        $fastToken = Crypt::encryptString(json_encode($payload));
        $jsToken = $spamService->getJsExpectedToken();

        $response = $this->post(route('contact.store'), [
            'name' => 'Fast Bot',
            'email' => 'fast@bot.com',
            'message' => 'Instant message',
            '_form_submission_token' => $fastToken,
            '_js_interaction_token' => $jsToken,
            '_hp_website' => '',
            '_hp_company' => '',
            '_hp_fax_check' => '',
        ]);

        $response->assertRedirect();
        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'fast@bot.com',
        ]);
    }

    public function test_spam_keyword_or_disposable_domain_is_blocked(): void
    {
        $tokens = $this->createValidTokens();

        $response = $this->post(route('contact.store'), array_merge([
            'name' => 'Crypto Bot',
            'email' => 'spammer@immenseignite.info',
            'message' => 'Claim your crypto airdrop now at t.me/fake_channel',
        ], $tokens));

        $response->assertRedirect();
        $this->assertDatabaseMissing('contact_messages', [
            'email' => 'spammer@immenseignite.info',
        ]);
    }

    public function test_duplicate_submission_blast_is_blocked(): void
    {
        $tokens = $this->createValidTokens();
        $data = array_merge([
            'name' => 'Repeat User',
            'email' => 'repeat@test.com',
            'message' => 'Exact duplicate test message content',
        ], $tokens);

        // First attempt succeeds
        $first = $this->post(route('contact.store'), $data);
        $first->assertRedirect();
        $this->assertDatabaseHas('contact_messages', [
            'email' => 'repeat@test.com',
        ]);

        // Immediate duplicate submission gets blocked
        $second = $this->post(route('contact.store'), $data);
        $second->assertRedirect();

        $this->assertEquals(1, ContactMessage::where('email', 'repeat@test.com')->count());
    }

    public function test_legitimate_human_contact_submission_is_saved_successfully(): void
    {
        $tokens = $this->createValidTokens();

        $response = $this->post(route('contact.store'), array_merge([
            'name' => 'عميل حقيقي',
            'email' => 'client@example.com',
            'message' => 'أرغب في تطوير متجر إلكتروني لمؤسستنا.',
        ], $tokens));

        $response->assertRedirect();
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'عميل حقيقي',
            'email' => 'client@example.com',
        ]);
    }

    public function test_design_request_form_is_protected_against_bots(): void
    {
        // Bot with honeypot
        $tokens = $this->createValidTokens();
        $tokens['_hp_company'] = 'Spam Corp';

        $response = $this->post(route('request-design.store'), array_merge([
            'full_name' => 'Bot Design Spammer',
            'email' => 'bot-design@spammer.com',
            'phone' => '+966500000000',
            'project_type' => 'website',
            'details' => 'Buy our SEO and design packages',
        ], $tokens));

        $response->assertRedirect();
        $this->assertDatabaseMissing('design_requests', [
            'email' => 'bot-design@spammer.com',
        ]);
    }

    public function test_careers_form_is_protected_against_bots(): void
    {
        Storage::fake('public');
        $file = UploadedFile::fake()->create('cv.pdf', 100, 'application/pdf');

        // Bot without tokens
        $response = $this->post(route('careers.store'), [
            'name' => 'Bot Applicant',
            'email' => 'bot-applicant@spammer.com',
            'phone' => '+966500000000',
            'years_of_experience' => 3,
            'specialization' => 'Developer',
            'cv' => $file,
        ]);

        $response->assertRedirect();
        $this->assertDatabaseMissing('job_applications', [
            'email' => 'bot-applicant@spammer.com',
        ]);
    }

    public function test_testimonial_form_is_protected_against_bots(): void
    {
        // Bot with honeypot
        $tokens = $this->createValidTokens();
        $tokens['_hp_fax_check'] = '12345';

        $response = $this->post(route('testimonial.store'), array_merge([
            'client_name' => 'Spam Reviewer',
            'client_position' => 'CEO',
            'client_company' => 'Spam Ltd',
            'testimonial' => 'Great casino website please visit us',
            'rating' => 5,
        ], $tokens));

        $response->assertRedirect();
        $this->assertDatabaseMissing('testimonials', [
            'client_name' => 'Spam Reviewer',
        ]);
    }
}
