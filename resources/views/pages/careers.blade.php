<x-layouts.app>
    {{-- Hero --}}
    <section class="relative py-20 overflow-hidden" style="background: linear-gradient(135deg, {{ config('colors.bg_dark') }} 0%, #1a2942 100%);">
                 <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl">
                <h1 class="text-5xl font-black text-white mb-6">
                    انضم إلى <span style="color: {{ config('colors.primary_light') }};">فريقنا</span>
                </h1>
                <p class="text-xl text-gray-300 leading-relaxed">
                    نبحث عن مواهب مبدعة لتطوير حلول برمجية مبتكرة. إذا كنت شغوفاً بالتكنولوجيا، انضم إلينا!
                </p>
            </div>
        </div>
        
        {{-- Decorative Elements --}}
        <div class="absolute top-0 right-0 w-96 h-96 bg-teal-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
    </section>

    {{-- Application Form --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-3xl mx-auto">
                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-8 p-6 bg-green-50 border-r-4 border-green-500 rounded-lg">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                            <p class="text-green-800 font-semibold">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                {{-- Form Card --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <div class="p-8 border-b border-gray-100" style="background: linear-gradient(135deg, {{ config('colors.primary') }} 0%, {{ config('colors.primary_light') }} 100%);">
                        <h2 class="text-3xl font-bold text-white mb-2">قدّم طلبك الآن</h2>
                        <p class="text-teal-50">املأ النموذج أدناه وسنتواصل معك في أقرب وقت</p>
                    </div>

                    <form action="{{ route('careers.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                        @csrf

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-user text-teal-600 ml-2"></i>
                                    الاسم الكامل
                                </label>
                                <input type="text" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all @error('name') border-red-500 @enderror"
                                       placeholder="أدخل اسمك الكامل"
                                       required>
                                @error('name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-envelope text-teal-600 ml-2"></i>
                                    البريد الإلكتروني
                                </label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all @error('email') border-red-500 @enderror"
                                       placeholder="example@email.com"
                                       required>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            {{-- Phone --}}
                            <div>
                                <label for="phone" class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-phone text-teal-600 ml-2"></i>
                                    رقم الهاتف
                                </label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       value="{{ old('phone') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all @error('phone') border-red-500 @enderror"
                                       placeholder="+966 50 123 4567"
                                       required>
                                @error('phone')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- Years of Experience --}}
                            <div>
                                <label for="years_of_experience" class="block text-gray-700 font-semibold mb-2">
                                    <i class="fas fa-briefcase text-teal-600 ml-2"></i>
                                    سنوات الخبرة
                                </label>
                                <input type="number" 
                                       id="years_of_experience" 
                                       name="years_of_experience" 
                                       value="{{ old('years_of_experience') }}"
                                       min="0" 
                                       max="50"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all @error('years_of_experience') border-red-500 @enderror"
                                       placeholder="عدد سنوات الخبرة"
                                       required>
                                @error('years_of_experience')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- Specialization --}}
                        <div class="mb-6">
                            <label for="specialization" class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-code text-teal-600 ml-2"></i>
                                التخصص
                            </label>
                            <input type="text" 
                                   id="specialization" 
                                   name="specialization" 
                                   value="{{ old('specialization') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all @error('specialization') border-red-500 @enderror"
                                   placeholder="مثال: مطور Full Stack، مصمم UI/UX، مطور تطبيقات جوال"
                                   required>
                            @error('specialization')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- CV Upload --}}
                        <div class="mb-8">
                            <label for="cv" class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-file-pdf text-teal-600 ml-2"></i>
                                السيرة الذاتية (CV)
                            </label>
                            <div class="relative">
                                <input type="file" 
                                       id="cv" 
                                       name="cv" 
                                       accept=".pdf,.doc,.docx"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all @error('cv') border-red-500 @enderror"
                                       required>
                                <p class="mt-2 text-sm text-gray-500">
                                    <i class="fas fa-info-circle ml-1"></i>
                                    الصيغ المقبولة: PDF, DOC, DOCX (الحد الأقصى: 20 ميجابايت)
                                </p>
                            </div>
                            @error('cv')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" 
                                class="w-full cursor-pointer text-white font-bold py-4 px-6 rounded-xl hover:opacity-90 transition-all flex items-center justify-center gap-3 text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5"
                                style="background: linear-gradient(135deg, {{ config('colors.primary') }} 0%, {{ config('colors.primary_light') }} 100%);">
                            <i class="fas fa-paper-plane"></i>
                            <span>إرسال الطلب</span>
                        </button>
                    </form>
                </div>

                {{-- Info Section --}}
                <div class="mt-12 grid md:grid-cols-3 gap-6">
                    <div class="bg-white p-6 rounded-xl shadow-md text-center">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-teal-600 text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">فريق متميز</h3>
                        <p class="text-gray-600 text-sm">انضم لفريق من المحترفين المبدعين</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md text-center">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-rocket text-teal-600 text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">مشاريع مبتكرة</h3>
                        <p class="text-gray-600 text-sm">اعمل على مشاريع تقنية متطورة</p>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-md text-center">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-line text-teal-600 text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-2">تطوير مستمر</h3>
                        <p class="text-gray-600 text-sm">فرص للنمو والتعلم المستمر</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>
