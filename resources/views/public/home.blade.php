@extends('layouts.public')

@section('title', config('portfolio.seo.title'))

@section('content')
{{-- Hero Section - Modern 2026 Design --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    {{-- Animated Blobs Background --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
        
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 bg-[linear-gradient(rgba(99,102,241,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(99,102,241,0.03)_1px,transparent_1px)] bg-[size:80px_80px]"></div>
        
        {{-- Floating Particles --}}
        <div class="absolute top-[20%] left-[20%] w-3 h-3 bg-indigo-400 rounded-full floating"></div>
        <div class="absolute top-[30%] right-[25%] w-4 h-4 bg-indigo-300 rounded-full floating-delayed"></div>
        <div class="absolute bottom-[25%] left-[35%] w-2 h-2 bg-indigo-500 rounded-full floating" style="animation-delay: 1s;"></div>
        <div class="absolute top-[60%] right-[35%] w-3 h-3 bg-purple-400 rounded-full floating" style="animation-delay: 3s;"></div>
        <div class="absolute top-[15%] right-[15%] w-2 h-2 bg-pink-400 rounded-full floating-delayed" style="animation-delay: 0.5s;"></div>
        <div class="absolute bottom-[40%] left-[15%] w-2 h-2 bg-indigo-300 rounded-full floating" style="animation-delay: 2.5s;"></div>
        <div class="absolute top-[45%] left-[10%] w-3 h-3 bg-violet-400 rounded-full floating-delayed" style="animation-delay: 1.5s;"></div>
        <div class="absolute bottom-[15%] right-[20%] w-2 h-2 bg-blue-400 rounded-full floating" style="animation-delay: 4s;"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 pt-40">
        <div class="grid lg:grid-cols-12 gap-12 items-center">
            {{-- Left Content --}}
            <div class="lg:col-span-7 text-center lg:text-left space-y-8" data-aos="fade-right" data-aos-delay="100">
                {{-- Status Badge --}}
                <div class="inline-flex items-center gap-3 px-5 py-2.5 rounded-full bento-card text-sm font-medium shimmer glow-on-hover">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    <span class="text-gray-700 dark:text-gray-300">Available for opportunities</span>
                </div>
                
                {{-- Main Heading --}}
                <div class="space-y-4 stagger-fade">
                    <p class="text-lg text-primary-500 font-semibold tracking-wide uppercase">
                        👋 Hello, I'm
                    </p>
                    <h1 class="text-5xl sm:text-6xl lg:text-7xl xl:text-8xl font-display font-bold tracking-tight leading-none">
                        <span class="animate-gradient-text">{{ config('portfolio.owner.name') }}</span>
                    </h1>
                    <div class="flex items-center gap-3 justify-center lg:justify-start flex-wrap">
                        <span class="px-4 py-2 rounded-xl bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 font-semibold text-lg scale-on-hover cursor-default">
                            Web Developer
                        </span>
                        <span class="text-gray-300 dark:text-gray-600 text-2xl">•</span>
                        <span class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 font-semibold text-lg scale-on-hover cursor-default">
                            Content Creator
                        </span>
                    </div>
                </div>
                
                {{-- Description --}}
                <p class="text-xl text-gray-600 dark:text-gray-400 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                    Passionate about creating innovative digital solutions through technology. 
                    Specializing in <span class="text-indigo-600 dark:text-indigo-400 font-semibold hover-underline">web development</span>, 
                    <span class="text-slate-700 dark:text-slate-300 font-semibold hover-underline">photography</span>, and 
                    <span class="text-slate-700 dark:text-slate-300 font-semibold hover-underline">video editing</span>.
                </p>
                
                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                    <a href="{{ route('projects.index') }}" class="group relative inline-flex items-center px-8 py-4 rounded-2xl btn-primary text-white font-bold text-lg overflow-hidden magnetic-btn ripple glow-on-hover">
                        <span class="relative z-10 flex items-center">
                            <span>View My Work</span>
                            <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </span>
                    </a>
                    <a href="{{ route('contact.index') }}" class="group inline-flex items-center px-8 py-4 rounded-2xl btn-outline text-gray-700 dark:text-gray-300 font-bold text-lg magnetic-btn">
                        <i class="fas fa-paper-plane mr-2 group-hover:rotate-12 transition-transform"></i>
                        <span>Let's Connect</span>
                    </a>
                </div>
                
                {{-- Social Links --}}
                <div class="flex items-center justify-center lg:justify-start gap-4 pt-4">
                    <a href="https://github.com/PrasetyaRiski" target="_blank" class="w-12 h-12 rounded-xl bento-card flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white icon-bounce glow-on-hover transition-all">
                        <i class="fab fa-github text-xl"></i>
                    </a>
                    <a href="https://www.instagram.com/ki_rzkii?igsh=aWFuMjl1YXhpeXk3" target="_blank" class="w-12 h-12 rounded-xl bento-card flex items-center justify-center text-gray-600 dark:text-gray-400 hover:text-pink-500 icon-bounce glow-on-hover transition-all">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                </div>
            </div>
            
            {{-- Right Content - Profile Card --}}
            <div class="lg:col-span-5 relative flex items-center justify-center" data-aos="fade-left" data-aos-delay="300">
                {{-- Decorative Elements --}}
                <div class="absolute w-[350px] h-[350px] sm:w-[450px] sm:h-[450px] rounded-full border border-indigo-200/30 dark:border-indigo-800/30 spin-slow"></div>
                <div class="absolute w-[300px] h-[300px] sm:w-[400px] sm:h-[400px] rounded-full border border-slate-200/30 dark:border-slate-700/30 spin-slow" style="animation-direction: reverse; animation-duration: 25s;"></div>
                
                {{-- Profile Card - Modern Bento Style --}}
                <div class="relative w-[300px] h-[380px] sm:w-[340px] sm:h-[440px] rounded-3xl overflow-hidden bento-card group tilt-card img-zoom">
                    <img src="{{ get_avatar() }}?v={{ time() }}" alt="{{ config('portfolio.owner.name') }}" class="absolute inset-0 w-full h-full object-cover transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/20 to-transparent"></div>
                    
                    {{-- Card Content --}}
                    <div class="absolute bottom-0 left-0 right-0 p-6">
                        <p class="text-xl font-bold text-white mb-1">{{ config('portfolio.owner.name') }}</p>
                    
                        <div class="flex items-center gap-2 mt-3">
                            <span class="px-3 py-1 rounded-full bg-white/20 backdrop-blur-sm text-white text-xs font-medium">
                                <i class="fas fa-map-marker-alt mr-1"></i> Ponorogo
                            </span>
                        </div>
                    </div>
                    
                    {{-- Floating Tech Badges --}}
                    <div class="absolute -top-3 -right-3 w-14 h-14 rounded-2xl bento-card flex items-center justify-center floating shadow-lg icon-bounce">
                        <i class="fab fa-laravel text-2xl text-red-500"></i>
                    </div>
                    <div class="absolute -bottom-3 -left-3 w-14 h-14 rounded-2xl bento-card flex items-center justify-center floating-delayed shadow-lg icon-bounce">
                        <i class="fab fa-js text-2xl text-yellow-500"></i>
                    </div>
                    <div class="absolute top-1/2 -left-6 w-12 h-12 rounded-xl bento-card flex items-center justify-center floating shadow-lg icon-bounce" style="animation-delay: 2s;">
                        <i class="fab fa-figma text-xl text-purple-500"></i>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Stats Row --}}
        <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-4 stagger-fade" data-aos="fade-up" data-aos-delay="500">
            <div class="bento-card rounded-2xl p-6 text-center hover-lift tilt-card glow-on-hover">
                <p class="text-4xl font-bold gradient-text-static mb-1">{{ $featuredProjects->count() }}+</p>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Projects</p>
            </div>
            <div class="bento-card rounded-2xl p-6 text-center hover-lift tilt-card glow-on-hover">
                <p class="text-4xl font-bold gradient-text-static mb-1">{{ $featuredCertificates->count() }}+</p>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Certificates</p>
            </div>
            <div class="bento-card rounded-2xl p-6 text-center hover-lift tilt-card glow-on-hover">
                <p class="text-4xl font-bold gradient-text-static mb-1">{{ $allSkills->flatten()->count() }}+</p>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Skills</p>
            </div>
            <div class="bento-card rounded-2xl p-6 text-center hover-lift tilt-card glow-on-hover">
                <p class="text-4xl font-bold gradient-text-static mb-1">3+</p>
                <p class="text-gray-500 dark:text-gray-400 text-sm font-medium">Years Learning</p>
            </div>
        </div>
        
        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 -translate-x-1/2 hidden lg:flex flex-col items-center gap-2 text-gray-400">
            <span class="text-xs font-medium tracking-widest uppercase">Scroll</span>
            <div class="w-6 h-10 rounded-full border-2 border-gray-300 dark:border-gray-700 flex justify-center pt-2">
                <div class="w-1.5 h-3 bg-indigo-500 rounded-full animate-bounce"></div>
            </div>
        </div>
    </div>
</section>

{{-- About Section - Bento Grid --}}
<section id="about" class="relative py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-6 glow-on-hover">
                <i class="fas fa-user-circle"></i>
                About Me
            </span>
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold mb-6">
                Get to <span class="animate-gradient-text">Know Me</span>
            </h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">
                A passionate IT student dedicated to creating innovative solutions through technology
            </p>
        </div>
        
        {{-- Bento Grid Layout --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            {{-- Main About Card (Large) --}}
            <div class="lg:col-span-2 bento-card rounded-3xl p-8 tilt-card" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white flex-shrink-0 icon-bounce">
                        <i class="fas fa-rocket text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-2">Who I Am</h3>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            I'm a <strong class="text-indigo-600 dark:text-indigo-400">{{ config('portfolio.owner.title') }}</strong> 
                            at <strong class="text-slate-700 dark:text-slate-300">{{ config('portfolio.owner.university') }}</strong>. 
                            With a strong foundation in web development and creative design, I'm constantly learning 
                            and adapting to new technologies to stay at the forefront of innovation.
                        </p>
                    </div>
                </div>
                
                {{-- Quick Info Grid --}}
                <div class="grid grid-cols-2 gap-4 mt-6">
                    <div class="p-4 rounded-2xl bg-gray-50 dark:bg-gray-800/50 scale-on-hover">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Location</p>
                        <p class="font-semibold flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-indigo-500"></i>
                            Ponorogo, Indonesia
                        </p>
                    </div>
                    <div class="p-4 rounded-2xl bg-gray-50 dark:bg-gray-800/50 scale-on-hover">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Focus</p>
                        <div class="space-y-1">
                            <p class="font-semibold flex items-center gap-2 text-sm">
                                <i class="fas fa-code text-indigo-500"></i>
                                Full Stack Web
                            </p>
                            <p class="font-semibold flex items-center gap-2 text-sm">
                                <i class="fas fa-video text-indigo-500"></i>
                                Videographer
                            </p>
                            <p class="font-semibold flex items-center gap-2 text-sm">
                                <i class="fas fa-camera text-indigo-500"></i>
                                Photographer
                            </p>
                            <p class="font-semibold flex items-center gap-2 text-sm">
                                <i class="fas fa-film text-indigo-500"></i>
                                Video Editor
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Education Card --}}
            <div class="bento-card rounded-3xl p-6 tilt-card" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white mb-4 icon-bounce">
                    <i class="fas fa-graduation-cap text-lg"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">Education</h4>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">Current Study</p>
                <div class="space-y-3">
                    <p class="font-semibold text-indigo-600 dark:text-indigo-400">Teknik Informatika</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ config('portfolio.owner.university') }}</p>
                    <span class="inline-block px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-medium">
                        2023 - Present
                    </span>
                </div>
            </div>
            
            {{-- Passion Card --}}
            <div class="bento-card rounded-3xl p-6 tilt-card" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-600 to-slate-700 flex items-center justify-center text-white mb-4 icon-bounce">
                    <i class="fas fa-heart text-lg"></i>
                </div>
                <h4 class="text-xl font-bold mb-2">Passion</h4>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-4">What Drives Me</p>
                <div class="flex flex-wrap gap-2 stagger-fade">
                    <span class="tag-pill px-3 py-1.5 rounded-lg text-xs font-medium scale-on-hover cursor-default">🎨 Creative Design</span>
                    <span class="tag-pill px-3 py-1.5 rounded-lg text-xs font-medium scale-on-hover cursor-default">💻 Coding</span>
                    <span class="tag-pill px-3 py-1.5 rounded-lg text-xs font-medium scale-on-hover cursor-default">📹 Video Editing</span>
                    <span class="tag-pill px-3 py-1.5 rounded-lg text-xs font-medium scale-on-hover cursor-default">📸 Photography</span>
                </div>
            </div>
            
            {{-- Tech Stack Card (Wide) --}}
            <div class="md:col-span-2 bento-card rounded-3xl p-8 tilt-card" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-2xl font-bold">My Tech Stack</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Technologies I work with</p>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white icon-bounce">
                        <i class="fas fa-layer-group text-lg"></i>
                    </div>
                </div>
                
                <div class="grid grid-cols-4 sm:grid-cols-6 gap-4 stagger-fade">
                    @php
                        $techStack = [
                            ['icon' => 'fab fa-html5', 'name' => 'HTML5', 'color' => 'text-orange-500'],
                            ['icon' => 'fab fa-css3-alt', 'name' => 'CSS3', 'color' => 'text-blue-500'],
                            ['icon' => 'fab fa-js', 'name' => 'JavaScript', 'color' => 'text-yellow-500'],
                            ['icon' => 'fab fa-php', 'name' => 'PHP', 'color' => 'text-indigo-500'],
                            ['icon' => 'fab fa-laravel', 'name' => 'Laravel', 'color' => 'text-red-500'],
                            ['icon' => 'fas fa-wind', 'name' => 'Tailwind', 'color' => 'text-cyan-500'],
                            ['icon' => 'fab fa-bootstrap', 'name' => 'Bootstrap', 'color' => 'text-purple-500'],
                            ['icon' => 'fab fa-github', 'name' => 'GitHub', 'color' => 'text-gray-700 dark:text-gray-300'],
                            ['icon' => 'fab fa-figma', 'name' => 'Figma', 'color' => 'text-pink-500'],
                            ['icon' => 'fas fa-database', 'name' => 'MySQL', 'color' => 'text-blue-600'],
                            ['icon' => 'fab fa-git-alt', 'name' => 'Git', 'color' => 'text-orange-600'],
                            ['icon' => 'fas fa-scissors', 'name' => 'CapCut', 'color' => 'text-gray-800 dark:text-white'],
                        ];
                        
                        $customLogos = [
                            ['image' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/premierepro/premierepro-original.svg', 'name' => 'Premiere Pro'],
                        ];
                    @endphp
                    
                    @foreach($techStack as $tech)
                    <div class="group flex flex-col items-center p-4 rounded-2xl hover:bg-gray-100 dark:hover:bg-gray-800/50 transition-all cursor-pointer icon-bounce glow-on-hover">
                        <i class="{{ $tech['icon'] }} text-3xl {{ $tech['color'] }} group-hover:scale-110 transition-transform"></i>
                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-2 font-medium">{{ $tech['name'] }}</span>
                    </div>
                    @endforeach
                    
                    @foreach($customLogos as $logo)
                    <div class="group flex flex-col items-center p-4 rounded-2xl hover:bg-gray-100 dark:hover:bg-gray-800/50 transition-all cursor-pointer icon-bounce glow-on-hover">
                        <img src="{{ $logo['image'] }}" alt="{{ $logo['name'] }}" class="w-8 h-8 group-hover:scale-110 transition-transform">
                        <span class="text-xs text-gray-500 dark:text-gray-400 mt-2 font-medium">{{ $logo['name'] }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Experience & Education Section --}}
<section id="experience" class="relative py-24 overflow-hidden bg-gray-50/50 dark:bg-gray-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-6 glow-on-hover">
                <i class="fas fa-route"></i>
                My Journey
            </span>
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold">
                Experience & <span class="animate-gradient-text">Education</span>
            </h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            {{-- Experience Column --}}
            <div data-aos="fade-right">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white icon-bounce">
                        <i class="fas fa-briefcase text-lg"></i>
                    </div>
                    <h3 class="text-2xl font-bold">Pengalaman</h3>
                </div>
                
                <div class="space-y-6 stagger-fade">
                    {{-- Experience Item 1 --}}
                    <div class="bento-card rounded-2xl p-6 relative border-l-4 border-indigo-500 tilt-card">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-semibold">
                                2024 - Sekarang
                            </span>
                            <span class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-medium">
                                Organisasi
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Pengurus HIMAKA</h4>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mb-2">Universitas Muhammadiyah Ponorogo</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1">
                            <i class="fas fa-map-marker-alt"></i>
                            Jl. Budi Utomo No.10, Ronowijayan, Kec. Ponorogo
                        </p>
                    </div>

                    {{-- Experience Item 2 --}}
                    <div class="bento-card rounded-2xl p-6 relative border-l-4 border-slate-400 tilt-card">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold">
                                2022
                            </span>
                            <span class="px-3 py-1 rounded-full bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 text-xs font-medium">
                                Magang
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Servis Komputer</h4>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mb-2">MATS KOMPUTER</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1">
                            <i class="fas fa-map-marker-alt"></i>
                            Sambit, Ponorogo
                        </p>
                    </div>

                    {{-- Experience Item 3 --}}
                    <div class="bento-card rounded-2xl p-6 relative border-l-4 border-slate-400 tilt-card">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold">
                                2021
                            </span>
                            <span class="px-3 py-1 rounded-full bg-purple-100 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400 text-xs font-medium">
                                Ekstrakurikuler
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Jurnalistik</h4>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mb-2">SMKN 1 Slahung Ponorogo</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1">
                            <i class="fas fa-map-marker-alt"></i>
                            Jl. Macan Tutul, Galak, Kec. Slahung
                        </p>
                    </div>

                    {{-- Experience Item 4 --}}
                    <div class="bento-card rounded-2xl p-6 relative border-l-4 border-slate-400">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold">
                                2020 - 2022
                            </span>
                            <span class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-medium">
                                Organisasi
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Pengurus OSIS</h4>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mb-2">SMKN 1 Slahung</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1">
                            <i class="fas fa-map-marker-alt"></i>
                            Jl. Macan Tutul, Galak, Kec. Slahung
                        </p>
                    </div>

                    {{-- Experience Item 5 --}}
                    <div class="bento-card rounded-2xl p-6 relative border-l-4 border-slate-400">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold">
                                2019 - 2020
                            </span>
                            <span class="px-3 py-1 rounded-full bg-green-100 dark:bg-green-900/30 text-green-600 dark:text-green-400 text-xs font-medium">
                                Organisasi
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Pengurus OSIS & Dewan Galang Pramuka</h4>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mb-2">SMPN 1 Slahung</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1">
                            <i class="fas fa-map-marker-alt"></i>
                            Desa Menggare, Slahung, Ponorogo
                        </p>
                    </div>
                </div>
            </div>

            {{-- Education Column --}}
            <div data-aos="fade-left">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-slate-600 to-slate-700 flex items-center justify-center text-white">
                        <i class="fas fa-graduation-cap text-lg"></i>
                    </div>
                    <h3 class="text-2xl font-bold">Pendidikan</h3>
                </div>
                
                <div class="space-y-6">
                    {{-- Education Item 1 - Current --}}
                    <div class="bento-card rounded-2xl p-6 relative border-l-4 border-indigo-500">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-xs font-semibold">
                                2023 - Sekarang
                            </span>
                            <span class="px-3 py-1 rounded-full bg-amber-100 dark:bg-amber-900/30 text-amber-600 dark:text-amber-400 text-xs font-medium">
                                Universitas
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">S1 Teknik Informatika</h4>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mb-2">Universitas Muhammadiyah Ponorogo</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1">
                            <i class="fas fa-map-marker-alt"></i>
                            Jl. Budi Utomo No.10, Ronowijayan, Kec. Ponorogo
                        </p>
                    </div>

                    {{-- Education Item 2 --}}
                    <div class="bento-card rounded-2xl p-6 relative border-l-4 border-slate-400">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold">
                                2020 - 2023
                            </span>
                            <span class="px-3 py-1 rounded-full bg-cyan-100 dark:bg-cyan-900/30 text-cyan-600 dark:text-cyan-400 text-xs font-medium">
                                SMK
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Teknik Komputer & Jaringan</h4>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mb-2">SMKN 1 Slahung</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1">
                            <i class="fas fa-map-marker-alt"></i>
                            Jl. Macan Tutul, Galak, Kec. Slahung
                        </p>
                    </div>

                    {{-- Education Item 3 --}}
                    <div class="bento-card rounded-2xl p-6 relative border-l-4 border-slate-400">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold">
                                2018 - 2020
                            </span>
                            <span class="px-3 py-1 rounded-full bg-teal-100 dark:bg-teal-900/30 text-teal-600 dark:text-teal-400 text-xs font-medium">
                                SMP
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Sekolah Menengah Pertama</h4>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mb-2">SMPN 1 Slahung</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1">
                            <i class="fas fa-map-marker-alt"></i>
                            Desa Menggare, Slahung, Ponorogo
                        </p>
                    </div>

                    {{-- Education Item 4 --}}
                    <div class="bento-card rounded-2xl p-6 relative border-l-4 border-slate-400">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-semibold">
                                2011 - 2018
                            </span>
                            <span class="px-3 py-1 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 text-xs font-medium">
                                SD
                            </span>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white mb-1">Sekolah Dasar</h4>
                        <p class="text-indigo-600 dark:text-indigo-400 font-medium text-sm mb-2">SDN 4 Slahung</p>
                        <p class="text-gray-500 dark:text-gray-400 text-xs flex items-center gap-1">
                            <i class="fas fa-map-marker-alt"></i>
                            Jl. Mrayan, Gembes, Slahung, Kec. Slahung
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Featured Projects Section --}}
<section id="projects" class="relative py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row items-center justify-between mb-16 gap-6" data-aos="fade-up">
            <div class="text-center sm:text-left">
                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-6 glow-on-hover">
                    <i class="fas fa-folder-open"></i>
                    My Work
                </span>
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold">
                    Featured <span class="animate-gradient-text">Projects</span>
                </h2>
            </div>
            <a href="{{ route('projects.index') }}" class="group inline-flex items-center px-6 py-3 rounded-2xl btn-outline text-gray-700 dark:text-gray-300 font-semibold magnetic-btn">
                <span>View All</span>
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
        
        {{-- Projects Grid --}}
        @if($featuredProjects->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredProjects as $index => $project)
            <article class="group bento-card rounded-3xl overflow-hidden tilt-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                {{-- Project Image --}}
                <div class="relative aspect-video overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 img-zoom">
                    @if($project->featured_image_url)
                    <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover transition-transform duration-700">
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-500 to-indigo-600">
                        <i class="fas fa-project-diagram text-4xl text-white/50"></i>
                    </div>
                    @endif
                    
                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <div class="absolute bottom-4 left-4 right-4 flex items-center gap-3">
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="px-4 py-2 rounded-xl bg-white/20 backdrop-blur-sm text-white text-sm font-medium hover:bg-white/30 transition-colors">
                                <i class="fas fa-external-link-alt mr-1"></i> Demo
                            </a>
                            @endif
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="px-4 py-2 rounded-xl bg-white/20 backdrop-blur-sm text-white text-sm font-medium hover:bg-white/30 transition-colors">
                                <i class="fab fa-github mr-1"></i> Code
                            </a>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Category Badge --}}
                    <span class="absolute top-4 left-4 px-4 py-1.5 rounded-xl bg-white/90 dark:bg-gray-900/90 text-xs font-bold text-indigo-600 dark:text-indigo-400 shadow-lg">
                        {{ $project->category_label }}
                    </span>
                </div>
                
                {{-- Project Content --}}
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-3 group-hover:text-primary-500 transition-colors">
                        <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2 mb-4">
                        {{ $project->short_description ?? Str::limit(strip_tags($project->description), 100) }}
                    </p>
                    
                    {{-- Technologies --}}
                    @if($project->technologies)
                    <div class="flex flex-wrap gap-2">
                        @foreach(array_slice($project->technologies, 0, 3) as $tech)
                        <span class="tag-pill px-3 py-1 rounded-lg text-xs font-medium">
                            {{ $tech }}
                        </span>
                        @endforeach
                        @if(count($project->technologies) > 3)
                        <span class="px-3 py-1 rounded-lg bg-gray-100 dark:bg-gray-800 text-xs font-medium text-gray-500">
                            +{{ count($project->technologies) - 3 }}
                        </span>
                        @endif
                    </div>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 bento-card rounded-3xl" data-aos="fade-up">
            <div class="w-20 h-20 rounded-2xl bg-gray-100 dark:bg-gray-800 mx-auto mb-6 flex items-center justify-center">
                <i class="fas fa-folder-open text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold mb-2">No Projects Yet</h3>
            <p class="text-gray-500 dark:text-gray-400">Projects will appear here once added.</p>
        </div>
        @endif
    </div>
</section>

{{-- Skills Section --}}
<section id="skills" class="relative py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-6 glow-on-hover">
                <i class="fas fa-code"></i>
                My Skills
            </span>
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold mb-6">
                What I <span class="animate-gradient-text">Can Do</span>
            </h2>
            <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">
                A collection of skills I've developed throughout my journey
            </p>
        </div>
        
        {{-- Skills Grid --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($allSkills as $category => $skills)
            <div class="bento-card rounded-3xl p-6 tilt-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-500 to-indigo-600 flex items-center justify-center text-white icon-bounce">
                        @if($category == 'frontend')
                        <i class="fab fa-html5"></i>
                        @elseif($category == 'backend')
                        <i class="fas fa-server"></i>
                        @elseif($category == 'framework')
                        <i class="fas fa-layer-group"></i>
                        @elseif($category == 'tools')
                        <i class="fas fa-tools"></i>
                        @elseif($category == 'database')
                        <i class="fas fa-database"></i>
                        @elseif($category == 'design')
                        <i class="fas fa-palette"></i>
                        @else
                        <i class="fas fa-star"></i>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold capitalize">{{ $category }}</h3>
                </div>
                
                <div class="flex flex-wrap gap-2 stagger-fade">
                    @foreach($skills as $skill)
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-sm font-medium hover:bg-indigo-100 dark:hover:bg-indigo-900/30 hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors cursor-default scale-on-hover">
                        @if($skill->icon)
                            @if(str_starts_with($skill->icon, 'http'))
                                <img src="{{ $skill->icon }}" alt="{{ $skill->name }}" class="w-4 h-4">
                            @else
                                <i class="{{ $skill->icon }}"></i>
                            @endif
                        @endif
                        {{ $skill->name }}
                    </span>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Certificates Section --}}
<section id="certificates" class="relative py-24 overflow-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Section Header --}}
        <div class="flex flex-col sm:flex-row items-center justify-between mb-16 gap-6" data-aos="fade-up">
            <div class="text-center sm:text-left">
                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-6 glow-on-hover">
                    <i class="fas fa-certificate"></i>
                    Credentials
                </span>
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold">
                    My <span class="animate-gradient-text">Certificates</span>
                </h2>
            </div>
            <a href="{{ route('certificates.index') }}" class="group inline-flex items-center px-6 py-3 rounded-2xl btn-outline text-gray-700 dark:text-gray-300 font-semibold magnetic-btn">
                <span>View All</span>
                <svg class="w-5 h-5 ml-2 group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>
        
        {{-- Certificates Grid --}}
        @if($featuredCertificates->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($featuredCertificates as $index => $certificate)
            <article class="group bento-card rounded-3xl overflow-hidden tilt-card img-zoom" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="relative aspect-[4/3] overflow-hidden bg-gradient-to-br from-slate-100 to-slate-200 dark:from-slate-800 dark:to-slate-900 cursor-pointer" 
                     @if($certificate->image_url) onclick="openLightbox('{{ $certificate->image_url }}', '{{ $certificate->title }}')" @endif>
                    @if($certificate->image_url)
                    <img src="{{ $certificate->image_url }}" alt="{{ $certificate->title }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </div>
                    @else
                    <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-500 to-indigo-600">
                        <i class="fas fa-certificate text-5xl text-white/50"></i>
                    </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-2 group-hover:text-primary-500 transition-colors line-clamp-2">
                        {{ $certificate->title }}
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm mb-3">{{ $certificate->issuer }}</p>
                    @if($certificate->description)
                    <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2">
                        {{ $certificate->description }}
                    </p>
                    @endif
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-20 bento-card rounded-3xl" data-aos="fade-up">
            <div class="w-20 h-20 rounded-2xl bg-gray-100 dark:bg-gray-800 mx-auto mb-6 flex items-center justify-center">
                <i class="fas fa-certificate text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-bold mb-2">No Certificates Yet</h3>
            <p class="text-gray-500 dark:text-gray-400">Certificates will appear here once added.</p>
        </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
<section class="relative py-24 overflow-hidden">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative bento-card rounded-3xl p-12 text-center overflow-hidden" data-aos="zoom-in">
            {{-- Background Decoration --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute -top-24 -right-24 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-indigo-500/10 rounded-full blur-3xl"></div>
            </div>
            
            <div class="relative z-10">
                <span class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 text-sm font-semibold mb-6">
                    <i class="fas fa-handshake"></i>
                    Let's Work Together
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold mb-6">
                    Have a Project in <span class="gradient-text">Mind?</span>
                </h2>
                <p class="text-gray-600 dark:text-gray-400 text-lg mb-8 max-w-xl mx-auto">
                    I'm always open to discussing new projects, creative ideas or opportunities to be part of your vision.
                </p>
                <a href="{{ route('contact.index') }}" class="group inline-flex items-center px-8 py-4 rounded-2xl btn-primary text-white font-bold text-lg">
                    <span class="relative z-10 flex items-center">
                        <span>Get In Touch</span>
                        <i class="fas fa-paper-plane ml-3 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Lightbox Modal for Certificate Preview --}}
<div id="lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 backdrop-blur-sm" onclick="closeLightbox(event)">
    <button onclick="closeLightbox(event)" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10">
        <i class="fas fa-times text-3xl"></i>
    </button>
    <div class="relative max-w-5xl max-h-[90vh] mx-4">
        <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
        <p id="lightbox-title" class="text-white text-center mt-4 text-lg font-semibold"></p>
    </div>
</div>

<script>
function openLightbox(imageUrl, title) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    
    lightboxImage.src = imageUrl;
    lightboxImage.alt = title;
    lightboxTitle.textContent = title;
    
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(event) {
    if (event.target.id === 'lightbox' || event.target.closest('button')) {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    }
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const lightbox = document.getElementById('lightbox');
        if (!lightbox.classList.contains('hidden')) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }
});
</script>
@endsection
