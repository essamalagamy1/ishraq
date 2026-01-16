<?php

return [
    'direction' => 'rtl',
    
    'actions' => [
        'attach' => 'إرفاق',
        'attach_another' => 'إرفاق آخر',
        'attach_and_attach_another' => 'إرفاق وإرفاق آخر',
        'cancel' => 'إلغاء',
        'create' => 'إنشاء',
        'create_another' => 'إنشاء وإنشاء آخر',
        'create_and_create_another' => 'إنشاء وإنشاء آخر',
        'delete' => 'حذف',
        'detach' => 'فصل',
        'edit' => 'تعديل',
        'filter' => 'تصفية',
        'force_delete' => 'حذف نهائي',
        'open' => 'فتح',
        'replicate' => 'نسخ',
        'restore' => 'استعادة',
        'save' => 'حفظ',
        'save_changes' => 'حفظ التغييرات',
        'search' => 'بحث',
        'view' => 'عرض',
    ],

    'fields' => [
        'bulk_select_page' => [
            'label' => 'تحديد/إلغاء تحديد جميع العناصر للإجراءات الجماعية.',
        ],
        'bulk_select_record' => [
            'label' => 'تحديد/إلغاء تحديد العنصر :key للإجراءات الجماعية.',
        ],
        'search' => [
            'label' => 'بحث',
            'placeholder' => 'بحث',
            'indicator' => 'بحث',
        ],
    ],

    'pagination' => [
        'label' => 'التنقل بين الصفحات',
        'overview' => 'عرض :first إلى :last من أصل :total نتيجة',
        'previous' => 'السابق',
        'next' => 'التالي',
    ],

    'buttons' => [
        'dark_mode' => 'تبديل الوضع الداكن',
        'light_mode' => 'تبديل الوضع الفاتح',
        'logout' => 'تسجيل الخروج',
        'open_user_menu' => 'قائمة المستخدم',
    ],

    'widgets' => [
        'account' => [
            'heading' => 'مرحباً، :name',
        ],
        'filament_info' => [
            'heading' => 'معلومات Filament',
        ],
    ],
];
