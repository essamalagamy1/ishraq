<?php

namespace App\Filament\Resources\AnalyticsSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AnalyticsSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Google Analytics
                Toggle::make('ga_enabled')
                    ->label('تفعيل Google Analytics')
                    ->helperText('تفعيل تتبع Google Analytics 4 على الموقع')
                    ->columnSpanFull(),
                
                TextInput::make('ga_measurement_id')
                    ->label('معرف القياس (Measurement ID)')
                    ->placeholder('G-XXXXXXXXXX')
                    ->helperText('معرف القياس من Google Analytics للتتبع (مثال: G-XXXXXXXXXX)')
                    ->maxLength(20),

                TextInput::make('ga_property_id')
                    ->label('معرف الخاصية (Property ID)')
                    ->placeholder('123456789')
                    ->helperText('المعرف الرقمي للخاصية من Google Analytics (للتقارير والويدجتس) - احصل عليه من: الإدارة > إعدادات الخاصية')
                    ->numeric()
                    ->maxLength(20),

                // Google Tag Manager
                Toggle::make('gtm_enabled')
                    ->label('تفعيل Google Tag Manager')
                    ->helperText('تفعيل Google Tag Manager على الموقع')
                    ->columnSpanFull(),
                
                TextInput::make('gtm_container_id')
                    ->label('معرف الحاوية GTM (Container ID)')
                    ->placeholder('GTM-XXXXXXX')
                    ->helperText('معرف الحاوية من Google Tag Manager (مثال: GTM-XXXXXXX)'),
                
                // Facebook Pixel
                Toggle::make('fb_pixel_enabled')
                    ->label('تفعيل Facebook Pixel')
                    ->helperText('تفعيل Facebook Pixel للتتبع التسويقي')
                    ->columnSpanFull(),
                
                TextInput::make('fb_pixel_id')
                    ->label('معرف Facebook Pixel')
                    ->placeholder('XXXXXXXXXXXXXXX')
                    ->helperText('معرف Facebook Pixel من حساب Facebook Business'),
                
                // Cookie Consent Settings
                Toggle::make('cookie_consent_enabled')
                    ->label('تفعيل بانر Cookie Consent')
                    ->helperText('إظهار بانر موافقة الكوكيز للزوار')
                    ->default(true)
                    ->columnSpanFull(),
                
                Toggle::make('analytics_cookies_default')
                    ->label('تفعيل كوكيز التحليلات افتراضياً')
                    ->helperText('السماح بكوكيز التحليلات بشكل افتراضي')
                    ->default(false),
                
                Toggle::make('marketing_cookies_default')
                    ->label('تفعيل كوكيز التسويق افتراضياً')
                    ->helperText('السماح بكوكيز التسويق بشكل افتراضي')
                    ->default(false),
                
                Toggle::make('preferences_cookies_default')
                    ->label('تفعيل كوكيز التفضيلات افتراضياً')
                    ->helperText('السماح بكوكيز التفضيلات بشكل افتراضي')
                    ->default(false),
            ]);
    }
}
