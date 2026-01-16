<x-layouts.app>
    {{-- Hero - Compact --}}
    <section class="relative py-20 overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
                        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 30px 30px;"></div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background: {{ config('colors.primary_20') }}; border: 1px solid {{ config('colors.primary_30') }};">
                    <i class="fas fa-rocket" style="color: {{ config('colors.primary_light') }};"></i>
                    <span class="text-sm font-medium" style="color: {{ config('colors.primary_lighter') }};">ابدأ مشروعك اليوم</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-4">
                    اطلب <span style="color: {{ config('colors.primary_light') }};">تصميمك</span>
                </h1>
                <p class="text-gray-400 text-lg">
                    أخبرنا عن مشروعك وسنتواصل معك خلال 24 ساعة
                </p>
            </div>
        </div>
    </section>

    {{-- Form Section --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">
                @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-2xl p-8 mb-8 text-center">
                    <div class="w-16 h-16 rounded-full bg-green-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-white text-2xl"></i>
                    </div>
                    <h4 class="font-black text-green-800 text-xl mb-2">تم إرسال طلبك! 🎉</h4>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
                @endif

                <form action="{{ route('request-design.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    @csrf
                    
                    {{-- Form Header --}}
                    <div class="p-8 border-b border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900">معلومات المشروع</h2>
                        <p class="text-gray-600 mt-1">أكمل جميع الحقول المطلوبة</p>
                    </div>

                    <div class="p-8 space-y-8">
                        {{-- Personal Info --}}
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-user" style="color: {{ config('colors.primary') }};"></i>
                                المعلومات الشخصية
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">الاسم الكامل <span class="text-red-500">*</span></label>
                                    <input type="text" name="full_name" required
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                           placeholder="اسمك الكامل">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">البريد الإلكتروني <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" required
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                           placeholder="example@email.com">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">رقم الجوال <span class="text-red-500">*</span></label>
                                    <input type="tel" name="phone" required
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                           placeholder="+966 XX XXX XXXX">
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">اسم الشركة <span class="text-gray-400 font-normal">(اختياري)</span></label>
                                    <input type="text" name="company_name"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                           placeholder="اسم شركتك">
                                </div>
                            </div>
                        </div>

                        {{-- Project Details --}}
                        <div class="p-6 rounded-xl" style="background: {{ config('colors.primary_05') }};">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <i class="fas fa-layer-group" style="color: {{ config('colors.primary') }};"></i>
                                تفاصيل المشروع
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">نوع المشروع <span class="text-red-500">*</span></label>
                                    <select name="project_type" required
                                            class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all bg-white">
                                        <option value="">اختر نوع المشروع</option>
                                        <option value="موقع ويب">🌐 موقع ويب</option>
                                        <option value="تطبيق جوال">📱 تطبيق جوال (iOS/Android)</option>
                                        <option value="متجر إلكتروني">🛒 متجر إلكتروني</option>
                                        <option value="نظام إدارة">⚙️ نظام إدارة مخصص</option>
                                        <option value="تصميم UI/UX">🎨 تصميم UI/UX</option>
                                        <option value="أخرى">💡 أخرى</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">الميزانية المتوقعة</label>
                                    <input type="text" name="budget_range"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all bg-white"
                                           placeholder="مثال: 500 - 1000 ر.س">
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">الموعد النهائي</label>
                                    <input type="text" name="deadline"
                                           class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all bg-white"
                                           placeholder="مثال: خلال أسبوع">
                                </div>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">تفاصيل المشروع <span class="text-red-500">*</span></label>
                            <textarea name="details" rows="6" required
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all resize-none"
                                      placeholder="اكتب وصفاً تفصيلياً عن المشروع..."></textarea>
                        </div>

                        {{-- Attachment --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">مرفقات <span class="text-gray-400 font-normal">(اختياري)</span></label>
                            <input type="file" name="attachment"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:text-white file:cursor-pointer" style="background: white;"
                                   accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg">
                            <p class="text-gray-500 text-sm mt-2">PDF, Word, Excel, أو صور</p>
                        </div>
                    </div>

                    {{-- Submit --}}
                    <div class="p-8 bg-gray-50 border-t border-gray-100">
                        <button type="submit" class="cursor-pointer w-full text-white font-bold py-4 px-6 rounded-xl hover:opacity-90 transition-all flex items-center justify-center gap-2 text-lg" style="background: {{ config('colors.primary') }};">
                            <i class="fas fa-paper-plane"></i>
                            <span>إرسال الطلب</span>
                        </button>
                        <p class="text-center text-gray-500 text-sm mt-4">
                            بالضغط على "إرسال" فإنك توافق على 
                            <a href="{{ route('terms') }}" class="underline">الشروط والأحكام</a>
                        </p>
                    </div>
                </form>

                {{-- Benefits Cards --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-12">
                    <div class="text-center p-4">
                        <div class="w-12 h-12 mx-auto rounded-xl flex items-center justify-center mb-3" style="background: {{ config('colors.primary_10') }};">
                            <i class="fas fa-clock" style="color: {{ config('colors.primary') }};"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">رد سريع</h4>
                        <p class="text-gray-500 text-xs">خلال 24 ساعة</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="w-12 h-12 mx-auto rounded-xl flex items-center justify-center mb-3" style="background: rgba(34, 197, 94, 0.1);">
                            <i class="fas fa-gift text-green-500"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">عرض مجاني</h4>
                        <p class="text-gray-500 text-xs">بدون التزام</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="w-12 h-12 mx-auto rounded-xl flex items-center justify-center mb-3" style="background: rgba(168, 85, 247, 0.1);">
                            <i class="fas fa-shield-alt text-purple-500"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">ضمان الجودة</h4>
                        <p class="text-gray-500 text-xs">مراجعات مجانية</p>
                    </div>
                    <div class="text-center p-4">
                        <div class="w-12 h-12 mx-auto rounded-xl flex items-center justify-center mb-3" style="background: rgba(239, 68, 68, 0.1);">
                            <i class="fas fa-headset text-red-500"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm">دعم مستمر</h4>
                        <p class="text-gray-500 text-xs">متاحون دائماً</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
