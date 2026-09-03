<?php

namespace App\Services;

use App\Models\CompanySetting;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GoogleReviewsService
{
    protected ?string $placeId;
    protected ?string $apiKey;

    public function __construct()
    {
        $settings = CompanySetting::first();
        $this->placeId = $settings?->google_place_id ?: config('services.google.place_id', 'ChIJaZWC9s-eqaMRIK6tEKGwZlA');
        $this->apiKey = $settings?->google_places_api_key ?: config('services.google.places_api_key', env('GOOGLE_PLACES_API_KEY'));
    }

    /**
     * Fetch and sync latest reviews from Google Places API
     *
     * @return array ['success' => bool, 'synced' => int, 'message' => string]
     */
    public function syncReviews(): array
    {
        if (empty($this->apiKey)) {
            return [
                'success' => false,
                'synced' => 0,
                'message' => 'مفتاح Google Places API Key غير مسجل. يرجى إضافته في إعدادات الشركة.',
            ];
        }

        if (empty($this->placeId)) {
            return [
                'success' => false,
                'synced' => 0,
                'message' => 'Google Place ID غير متوفر.',
            ];
        }

        try {
            $url = 'https://maps.googleapis.com/maps/api/place/details/json';
            $response = Http::timeout(10)->get($url, [
                'place_id' => $this->placeId,
                'fields' => 'name,rating,reviews,user_ratings_total',
                'language' => 'ar',
                'key' => $this->apiKey,
            ]);

            if ($response->failed()) {
                return [
                    'success' => false,
                    'synced' => 0,
                    'message' => 'فشل الاتصال بـ Google Places API: ' . $response->status(),
                ];
            }

            $data = $response->json();

            if (isset($data['status']) && $data['status'] !== 'OK') {
                return [
                    'success' => false,
                    'synced' => 0,
                    'message' => 'خطأ من Google API: ' . ($data['error_message'] ?? $data['status']),
                ];
            }

            $reviews = $data['result']['reviews'] ?? [];
            $syncedCount = 0;

            foreach ($reviews as $rev) {
                $authorName = $rev['author_name'] ?? 'عميل من Google';
                $rating = (int) ($rev['rating'] ?? 5);
                $text = trim($rev['text'] ?? '');
                $authorPhoto = $rev['profile_photo_url'] ?? null;
                $authorUrl = $rev['author_url'] ?? null;
                $time = isset($rev['time']) ? date('Y-m-d H:i:s', $rev['time']) : now();

                if (empty($text)) {
                    continue;
                }

                // Check if already exists or update
                Testimonial::updateOrCreate(
                    [
                        'client_name' => $authorName,
                        'source' => 'google',
                    ],
                    [
                        'client_position' => 'مراجعة Google Maps',
                        'client_company' => 'Google Verified',
                        'client_avatar' => $authorPhoto,
                        'rating' => $rating,
                        'testimonial' => $text,
                        'badge_text' => 'مراجعة Google موثقة',
                        'badge_color_from' => 'amber-500',
                        'badge_color_to' => 'orange-500',
                        'is_verified' => true,
                        'is_featured' => true,
                        'is_active' => true,
                        'review_url' => $authorUrl ?: 'https://g.page/r/CSCurRChsGZQEBM/review',
                        'created_at' => $time,
                    ]
                );

                $syncedCount++;
            }

            return [
                'success' => true,
                'synced' => $syncedCount,
                'message' => "تمت مزامنة {$syncedCount} تقييم بنجاح من Google!",
            ];
        } catch (\Throwable $e) {
            Log::error('Google Reviews Sync Error: ' . $e->getMessage());
            return [
                'success' => false,
                'synced' => 0,
                'message' => 'حدث استثناء أثناء المزامنة: ' . $e->getMessage(),
            ];
        }
    }
}
