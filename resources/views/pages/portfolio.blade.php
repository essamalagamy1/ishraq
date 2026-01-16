<x-layouts.app>
    {{-- Hero Section with Animations --}}
    <section class="relative min-h-[30vh] flex items-center overflow-hidden" style="background: {{ config('colors.bg_dark') }};">
        <div class="absolute inset-0 opacity-[0.03]" style="background-image: radial-gradient(circle, #fff 1px, transparent 1px); background-size: 30px 30px;"></div>
        <div class="absolute top-10 right-10 w-3 h-3 rounded-full animate-float opacity-40" style="background: {{ config('colors.primary_light') }};"></div>
        <div class="absolute bottom-10 left-20 w-4 h-4 rounded-full animate-float opacity-30" style="background: {{ config('colors.primary_lighter') }}; animation-delay: 1s;"></div>
        <div class="container mx-auto px-6 relative z-10 py-20">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-8">
                <div class="max-w-2xl">
                    <div class="flex items-center gap-3 mb-6 text-gray-400 text-sm hero-animate animate-fade-in-up" style="animation-delay: 0.1s;">
                        <a href="{{ route('home') }}" class="hover:text-white transition">الرئيسية</a>
                        <i class="fas fa-chevron-left text-xs"></i>
                        <span style="color: {{ config('colors.primary_light') }};">أعمالنا</span>
                    </div>
                    @if($heroSection)
                    <h1 class="text-4xl md:text-6xl font-black text-white mb-4 hero-animate animate-fade-in-up" style="animation-delay: 0.2s;">
                        {{ $heroSection->title_line1 }}
                        <span class="gradient-text-animated">{{ $heroSection->title_line2 }}</span>
                    </h1>
                    @if($heroSection->subtitle)
                    <p class="text-gray-400 text-lg hero-animate animate-fade-in-up" style="animation-delay: 0.3s;">{{ $heroSection->subtitle }}</p>
                    @endif
                    @else
                    <h1 class="text-4xl md:text-6xl font-black text-white mb-4 hero-animate animate-fade-in-up" style="animation-delay: 0.2s;">
                        معرض <span class="gradient-text-animated">أعمالنا</span>
                    </h1>
                    <p class="text-gray-400 text-lg hero-animate animate-fade-in-up" style="animation-delay: 0.3s;">استعرض مشاريعنا الناجحة</p>
                    @endif
                </div>
                @if($stats && $stats->count() > 0)
                <div class="flex gap-8 hero-animate animate-fade-in-up" style="animation-delay: 0.4s;">
                    @foreach($stats->take(2) as $stat)
                    <div class="text-center group">
                        <div class="text-4xl font-black counter-number transition-transform group-hover:scale-110" style="color: {{ config('colors.primary_light') }};">{{ $stat->number }}</div>
                        <div class="text-gray-500 text-sm">{{ $stat->label }}</div>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
        </div>
    </section>

    {{-- Filter Bar - Dynamic from $projectTypes --}}
    @if(isset($projectTypes) && $projectTypes->count() > 0)
    <section class="py-6 bg-white border-b border-gray-100 sticky top-20 z-40">
        <div class="container mx-auto px-6">
            <div class="flex flex-wrap items-center gap-3 justify-center">
                {{-- All Projects - Dynamic filter --}}
                <a href="{{ route('portfolio') }}" 
                   class="px-5 py-2.5 rounded-full font-semibold text-sm transition-all {{ !$selectedType ? 'text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                   style="{{ !$selectedType ? 'background: ' . config('colors.primary') . ';' : '' }}">
                    الكل
                </a>
                
                {{-- Type Filters - Dynamic from database --}}
                @foreach($projectTypes as $type)
                <a href="{{ route('portfolio', ['type' => $type->slug]) }}" 
                   class="px-5 py-2.5 rounded-full font-semibold text-sm transition-all {{ $selectedType === $type->slug ? 'text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }}"
                   style="{{ $selectedType === $type->slug ? 'background: ' . $type->color . ';' : '' }}">
                    @if($type->icon)<i class="{{ $type->icon }} ml-1 text-xs"></i>@endif
                    {{ $type->name }}
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Projects Masonry Grid - Dynamic from $projects --}}
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-6">
            @if(isset($projects) && count($projects) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($projects as $index => $project)
                {{-- Project Card - Dynamic from database --}}
                <a href="{{ route('projects.show', $project) }}" 
                   class="group block bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500">
                    {{-- Image - Dynamic from database --}}
                    <div class="relative overflow-hidden">
                        <img src="{{ Storage::url($project->main_image) }}" 
                             alt="{{ $project->title }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        
                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div class="absolute bottom-6 left-6 right-6 text-white">
                                <div class="flex items-center gap-2 text-sm mb-2">
                                    <i class="fas fa-eye"></i>
                                    <span>عرض المشروع</span>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Type Badges - Dynamic from database --}}
                        @if($project->types && $project->types->count() > 0)
                        <div class="absolute top-4 right-4 flex flex-wrap gap-2">
                            @foreach($project->types->take(2) as $type)
                            <span class="px-3 py-1 rounded-full text-xs font-bold text-white backdrop-blur-sm" style="background: {{ $type->color }};"> 
                                {{ $type->name }}
                            </span>
                            @endforeach
                        </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-6">
                        {{-- Dynamic title from database --}}
                        <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-gray-600 transition-colors">
                            {{ $project->title }}
                        </h3>
                        {{-- Dynamic description from database --}}
                        <p class="text-gray-500 text-sm line-clamp-2">{{ $project->short_description }}</p>
                        
                        <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100">
                            <span class="text-xs text-gray-400">
                                {{ $project->created_at->format('Y/m/d') }}
                            </span>
                            <span class="text-sm font-semibold transition-all group-hover:gap-2 flex items-center gap-1" style="color: {{ config('colors.primary') }};">
                                التفاصيل
                                <i class="fas fa-arrow-left text-xs"></i>
                            </span>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-12">
                {{ $projects->appends(request()->query())->links() }}
            </div>
            @else
            {{-- Empty State --}}
            <div class="text-center py-20">
                <div class="w-24 h-24 mx-auto rounded-full flex items-center justify-center mb-6" style="background: {{ config('colors.primary_10') }};">
                    <i class="fas fa-folder-open text-4xl" style="color: {{ config('colors.primary') }};"></i>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">لا توجد مشاريع</h3>
                <p class="text-gray-600">لم نعثر على مشاريع تطابق بحثك</p>
            </div>
            @endif
        </div>
    </section>

    {{-- CTA Section --}}
    <section class="py-20" style="background: {{ config('colors.bg_dark') }};">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-black text-white mb-4">
                هل لديك مشروع في ذهنك؟
            </h2>
            <p class="text-gray-400 mb-8 max-w-xl mx-auto">
                دعنا نحوله إلى واقع - تواصل معنا للحصول على استشارة مجانية
            </p>
            <a href="{{ route('request-design.create') }}" class="inline-flex items-center gap-2 text-white font-bold py-4 px-8 rounded-xl transition-all hover:opacity-90" style="background: {{ config('colors.primary') }};">
                <i class="fas fa-rocket"></i>
                <span>ابدأ مشروعك</span>
            </a>
        </div>
    </section>
</x-layouts.app>
