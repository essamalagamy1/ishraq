<x-layouts.app>
    {{-- Hero --}}
    <section class="relative py-20 overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-3xl mx-auto text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full mb-6" style="background: {{ config('colors.primary_20') }}; border: 1px solid {{ config('colors.primary_30') }};">
                    <i class="fas fa-star" style="color: {{ config('colors.primary_light') }};"></i>
                    <span class="text-sm font-medium" style="color: {{ config('colors.primary_lighter') }};">شاركنا تجربتك</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-white mb-4">
                    أضف <span style="color: {{ config('colors.primary_light') }};">تقييمك</span>
                </h1>
                <p class="text-gray-400 text-lg">
                    رأيك يهمنا ويساعدنا على التحسين المستمر
                </p>
            </div>
        </div>
    </section>

    {{-- Testimonial Form --}}
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto">
                @if(session('success'))
                <div class="bg-green-50 border border-green-200 rounded-2xl p-8 mb-8 text-center">
                    <div class="w-16 h-16 rounded-full bg-green-500 flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-check text-white text-2xl"></i>
                    </div>
                    <h4 class="font-black text-green-800 text-xl mb-2">شكراً لك! 🎉</h4>
                    <p class="text-green-700">{{ session('success') }}</p>
                </div>
                @endif

                <form action="{{ route('testimonial.store') }}" method="POST" class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100">
                    @csrf
                    
                    <div class="space-y-6">
                        {{-- Rating --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">تقييمك <span class="text-red-500">*</span></label>
                            <div class="flex gap-2" id="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                <button type="button" class="rating-star text-3xl text-gray-300 hover:text-yellow-400 transition-colors" data-value="{{ $i }}">
                                    <i class="fas fa-star"></i>
                                </button>
                                @endfor
                            </div>
                            <input type="hidden" name="rating" id="rating-value" value="5" required>
                        </div>

                        {{-- Name --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">اسمك <span class="text-red-500">*</span></label>
                            <input type="text" name="client_name" required
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                   placeholder="اسمك الكامل">
                        </div>

                        {{-- Position --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">منصبك <span class="text-gray-400 font-normal">(اختياري)</span></label>
                            <input type="text" name="client_position"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                   placeholder="مثال: مدير تنفيذي">
                        </div>

                        {{-- Company --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">اسم الشركة <span class="text-gray-400 font-normal">(اختياري)</span></label>
                            <input type="text" name="client_company"
                                   class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all"
                                   placeholder="اسم شركتك">
                        </div>

                        {{-- Testimonial --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">تجربتك معنا <span class="text-red-500">*</span></label>
                            <textarea name="testimonial" rows="5" required
                                      class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:border-teal-500 focus:ring-2 focus:ring-teal-100 focus:outline-none transition-all resize-none"
                                      placeholder="شاركنا تجربتك..."></textarea>
                        </div>

                        <button type="submit" class="w-full text-white font-bold py-4 px-6 rounded-xl hover:opacity-90 transition-all flex items-center justify-center gap-2" style="background: {{ config('colors.primary') }};">
                            <i class="fas fa-paper-plane"></i>
                            <span>إرسال التقييم</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.rating-star');
            const ratingInput = document.getElementById('rating-value');
            
            // Set initial rating
            updateStars(5);
            
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = this.getAttribute('data-value');
                    ratingInput.value = value;
                    updateStars(value);
                });
            });
            
            function updateStars(rating) {
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-400');
                    } else {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    }
                });
            }
        });
    </script>
</x-layouts.app>
