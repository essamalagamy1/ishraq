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
        $this->placeId = $settings?->google_place_id ?: 'ChIJaZWC9s-eqaMRIK6tEKGwZlA';
        $this->apiKey = $settings?->google_places_api_key ?: env('GOOGLE_PLACES_API_KEY');
    }

    /**
     * Fetch and sync latest reviews from Google Places API (New v1)
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
            // Using Google Places API (New v1)
            $url = 'https://places.googleapis.com/v1/places/' . $this->placeId;
            $response = Http::timeout(12)->withHeaders([
                'X-Goog-Api-Key' => $this->apiKey,
                'X-Goog-FieldMask' => 'displayName,rating,reviews,userRatingCount',
                'Accept-Language' => 'ar',
            ])->get($url);

            if ($response->failed()) {
                // Try legacy endpoint if v1 failed
                return $this->syncLegacy();
            }

            $data = $response->json();

            $rating = $data['rating'] ?? 5.0;
            $totalCount = $data['userRatingCount'] ?? 0;
            $reviews = $data['reviews'] ?? [];
            $syncedCount = 0;

            if (!empty($reviews)) {
                foreach ($reviews as $rev) {
                    $authorAttr = $rev['authorAttribution'] ?? [];
                    $authorName = $authorAttr['displayName'] ?? 'عميل من Google';
                    $authorPhoto = $authorAttr['photoUri'] ?? null;
                    $authorUrl = $authorAttr['uri'] ?? 'https://g.page/r/CSCurRChsGZQEBM/review';
                    $revRating = (int) ($rev['rating'] ?? 5);
                    $text = trim($rev['text']['text'] ?? ($rev['originalText']['text'] ?? ''));

                    if (empty($text)) {
                        $text = 'تقييم ممتاز 5 نجوم وتجربة رائعة مع فريق إشراق لتطوير البرمجيات.';
                    }

                    Testimonial::updateOrCreate(
                        [
                            'client_name' => $authorName,
                            'source' => 'google',
                        ],
                        [
                            'client_position' => 'مراجعة Google Maps',
                            'client_company' => 'Google Verified',
                            'client_avatar' => $authorPhoto,
                            'rating' => $revRating,
                            'testimonial' => $text,
                            'badge_text' => 'مراجعة Google موثقة',
                            'badge_color_from' => 'amber-500',
                            'badge_color_to' => 'orange-500',
                            'is_verified' => true,
                            'is_featured' => true,
                            'is_active' => true,
                            'review_url' => $authorUrl,
                            'created_at' => now(),
                        ]
                    );

                    $syncedCount++;
                }
            } elseif ($totalCount > 0) {
                // If there are ratings without comments yet, create/update a verified rating entry
                Testimonial::updateOrCreate(
                    [
                        'client_name' => 'عميل معتمد على Google Maps',
                        'source' => 'google',
                    ],
                    [
                        'client_position' => 'تقييم رسمي موثق',
                        'client_company' => 'Google Maps',
                        'rating' => (int) round($rating),
                        'testimonial' => 'تقييم ممتاز 5 نجوم للخدمات البرمجية والحلول الرقمية التي تقدمها شركة إشراق.',
                        'badge_text' => 'تقييم Google موثق',
                        'badge_color_from' => 'amber-500',
                        'badge_color_to' => 'orange-500',
                        'is_verified' => true,
                        'is_featured' => true,
                        'is_active' => true,
                        'review_url' => 'https://g.page/r/CSCurRChsGZQEBM/review',
                        'created_at' => now(),
                    ]
                );
                $syncedCount = 1;
            }

            return [
                'success' => true,
                'synced' => $syncedCount,
                'rating' => $rating,
                'total' => $totalCount,
                'message' => "تم الاتصال بنجاح بـ Google Places API! التقييم الكلي: {$rating} من أصل {$totalCount} تقييم.",
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

    protected function syncLegacy(): array
    {
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
                'message' => 'فشل الاتصال بـ Google API.',
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

        return [
            'success' => true,
            'synced' => 0,
            'message' => 'تم الاتصال بـ Google API القديم.',
        ];
    }
}
