<?php

/**
 * Cookie Consent Configuration
 *
 * This file contains all the configuration options for the cookie consent system.
 * It allows customization of the cookie banner appearance, behavior, and compliance settings.
 *
 * @package Config
 * @author Muhammad Rabiul
 * @license MIT
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Cookie Consent Prefix
    |--------------------------------------------------------------------------
    | This setting determines whether the cookie consent banner should be displayed.
    | Set this value to 'true' to show the banner or 'false' to disable it.
    | You can control this via the .env file using APP_NAME.
    */
    'cookie_prefix' => env('APP_NAME', 'Laravel_App'),

    /**
     * Enable or disable the cookie consent banner
     *
     * @default true
     * @env COOKIE_CONSENT_ENABLED
     */
    'enabled' => env('COOKIE_CONSENT_ENABLED', true),

    /**
     * Cookie lifetime in days
     *
     * Defines how long the consent cookie should persist in the user's browser.
     *
     * @default 365
     * @env COOKIE_CONSENT_LIFETIME
     */
    'cookie_lifetime' => env('COOKIE_CONSENT_LIFETIME', 365),

    /**
     * Rejection cookie lifetime in days
     *
     * Specifies how long the rejection cookie should persist when users decline cookies.
     *
     * @default 7
     * @env COOKIE_REJECT_LIFETIME
     */
    'reject_lifetime' => env('COOKIE_REJECT_LIFETIME', 7),

    /**
     * Consent modal layout style
     *
     * Determines the visual presentation of the consent modal.
     *
     * @default 'bar-inline'
     * @env COOKIE_CONSENT_MODAL_LAYOUT
     * @option box - Small floating box
     * @option box-inline - Small floating box positioned inline
     * @option box-wide - Larger floating box
     * @option cloud - Cloud-like floating consent box
     * @option cloud-inline - Compact cloud-style box
     * @option bar - Simple bar at top or bottom
     * @option bar-inline - Compact inline bar
     */
    'consent_modal_layout' => env('COOKIE_CONSENT_MODAL_LAYOUT', 'bar'),

    /**
     * Enable preferences modal
     *
     * Determines if users can access detailed cookie preferences.
     *
     * @default false
     * @env COOKIE_CONSENT_PREFERENCES_ENABLED
     */
    'preferences_modal_enabled' => env('COOKIE_CONSENT_PREFERENCES_ENABLED', true),

    /**
     * Preferences modal layout style
     *
     * Defines the visual presentation of the preferences modal.
     *
     * @default 'bar'
     * @env COOKIE_CONSENT_PREFERENCES_LAYOUT
     * @option bar - Bar-style modal
     * @option box - Popup-style box
     */
    'preferences_modal_layout' => env('COOKIE_CONSENT_PREFERENCES_LAYOUT', 'bar'),

    /**
     * Enable flip button animation
     *
     * Adds a flip animation effect to consent buttons.
     *
     * @default true
     * @env COOKIE_CONSENT_FLIP_BUTTON
     */
    'flip_button' => env('COOKIE_CONSENT_FLIP_BUTTON', true),

    /**
     * Disable page interaction until consent
     *
     * When enabled, users must interact with the cookie banner before accessing content.
     *
     * @default true
     * @env COOKIE_CONSENT_DISABLE_INTERACTION
     */
    'disable_page_interaction' => env('COOKIE_CONSENT_DISABLE_INTERACTION', true),

    /**
     * Color theme for the cookie banner
     *
     * @default 'default'
     * @env COOKIE_CONSENT_THEME
     * @option default - Standard theme
     * @option dark - Dark mode theme
     * @option light - Light mode theme
     * @option custom - Custom styles (requires additional CSS)
     */
    'theme' => env('COOKIE_CONSENT_THEME', 'default'),

    /**
     * Cookie banner title text
     *
     * @default "Cookie Disclaimer"
     */
    'cookie_title' => "سياسة ملفات تعريف الارتباط",

    /**
     * Cookie banner description text
     *
     * @default "This website uses cookies to enhance your browsing experience, analyze site traffic, and personalize content. By continuing to use this site, you consent to our use of cookies."
     */
    'cookie_description' => "نستخدم ملفات تعريف الارتباط (Cookies) لتحسين تجربة التصفح وتحليل حركة المرور وتخصيص المحتوى. باستمرارك في استخدام هذا الموقع، فإنك توافق على استخدامنا لملفات تعريف الارتباط.",

    /**
     * Accept all cookies button text
     *
     * @default 'Accept all'
     */
    'cookie_accept_btn_text' => 'قبول الكل',

    /**
     * Reject all cookies button text
     *
     * @default 'Reject all'
     */
    'cookie_reject_btn_text' => 'رفض الكل',

    /**
     * Manage preferences button text
     *
     * @default 'Manage preferences'
     */
    'cookie_preferences_btn_text' => 'إدارة التفضيلات',

    /**
     * Save preferences button text
     *
     * @default 'Save preferences'
     */
    'cookie_preferences_save_text' => 'حفظ التفضيلات',

    /**
     * Preferences modal title text
     *
     * @default 'Cookie Preferences'
     */
    'cookie_modal_title' => 'تفضيلات ملفات تعريف الارتباط',

    /**
     * Preferences modal introduction text
     *
     * @default 'You can customize your cookie preferences below.'
     */
    'cookie_modal_intro' => 'يمكنك تخصيص تفضيلات ملفات تعريف الارتباط أدناه.',

    /**
     * Cookie categories configuration
     *
     * Defines the different types of cookies users can manage.
     *
     * @category necessary - Essential cookies that cannot be disabled
     * @category analytics - Cookies used for tracking and analytics
     * @category marketing - Cookies used for advertising
     * @category preferences - Cookies for user preference storage
     */
    'cookie_categories' => [
        'necessary' => [
            'enabled' => true,
            'locked' => true,
            'title' => 'ملفات تعريف الارتباط الأساسية',
            'description' => 'هذه الملفات ضرورية لعمل الموقع بشكل صحيح ولا يمكن تعطيلها.',
        ],
        'analytics' => [
            'enabled' => env('COOKIE_CONSENT_ANALYTICS', false),
            'locked' => false,
            'js_action' => 'loadGoogleAnalytics',
            'title' => 'ملفات تعريف التحليلات',
            'description' => 'تساعدنا هذه الملفات على فهم كيفية تفاعل الزوار مع موقعنا لتحسين الخدمة.',
        ],
        'marketing' => [
            'enabled' => env('COOKIE_CONSENT_MARKETING', false),
            'locked' => false,
            'js_action' => 'loadFacebookPixel',
            'title' => 'ملفات تعريف التسويق',
            'description' => 'تُستخدم هذه الملفات لأغراض الإعلان والتتبع التسويقي.',
        ],
        'preferences' => [
            'enabled' => env('COOKIE_CONSENT_PREFERENCES', false),
            'locked' => false,
            'title' => 'ملفات تعريف التفضيلات',
            'description' => 'تسمح هذه الملفات للموقع بتذكر تفضيلاتك وإعداداتك الشخصية.',
        ],
    ],

    /**
     * Policy links configuration
     *
     * Links to legal documents displayed in the cookie banner.
     *
     * @item text - Display text for the link
     * @item link - URL to the policy document
     */
    'policy_links' => [
        [
            'text' => 'سياسة الخصوصية',
            'link' => '/privacy-policy'
        ],
        [
            'text' => 'الشروط والأحكام',
            'link' => '/terms-conditions'
        ],
    ],
];

