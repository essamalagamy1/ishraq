<x-filament-panels::page>
    <div class="space-y-6">
        @if (!config('analytics.property_id'))
            <x-filament::section>
                <x-slot name="heading">
                    تنبيه: لم يتم تكوين Google Analytics
                </x-slot>

                <div class="text-sm text-gray-600 dark:text-gray-400 space-y-2">
                    <p>لعرض بيانات Google Analytics، يرجى اتباع الخطوات التالية:</p>
                    <ol class="list-decimal list-inside space-y-1 mr-4">
                        <li>احصل على معرف الخاصية الرقمي (Property ID) من Google Analytics</li>
                        <li>أضف المعرف إلى ملف <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">.env</code> كـ <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">ANALYTICS_PROPERTY_ID</code></li>
                        <li>تأكد من وجود ملف <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">service-account-credentials.json</code> في <code class="bg-gray-100 dark:bg-gray-800 px-2 py-1 rounded">storage/app/analytics/</code></li>
                    </ol>
                </div>
            </x-filament::section>
        @endif

        {{-- <x-filament-widgets::widgets
            :widgets="$this->getHeaderWidgets()"
            :columns="$this->getHeaderWidgetsColumns()"
        />

        <x-filament-widgets::widgets
            :widgets="$this->getFooterWidgets()"
            :columns="$this->getFooterWidgetsColumns()"
        /> --}}
    </div>
</x-filament-panels::page>
