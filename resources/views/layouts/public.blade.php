<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- SEO Meta Tags --}}
    <title>@yield('title', config('portfolio.seo.title'))</title>
    <meta name="description" content="@yield('description', config('portfolio.seo.description'))">
    <meta name="keywords" content="@yield('keywords', config('portfolio.seo.keywords'))">
    <meta name="author" content="{{ config('portfolio.seo.author') }}">
    
    {{-- Open Graph --}}
    <meta property="og:title" content="@yield('title', config('portfolio.seo.title'))">
    <meta property="og:description" content="@yield('description', config('portfolio.seo.description'))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    @hasSection('og_image')
        <meta property="og:image" content="@yield('og_image')">
    @endif
    
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    {{-- Fonts - Same as Admin Dashboard --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    {{-- AOS Animation Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    {{-- Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#eef2ff',
                            100: '#e0e7ff',
                            200: '#c7d2fe',
                            300: '#a5b4fc',
                            400: '#818cf8',
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                            800: '#3730a3',
                            900: '#312e81',
                        },
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'float-slow': 'float 8s ease-in-out infinite',
                        'slide-up': 'slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1)',
                        'fade-in': 'fadeIn 0.8s ease-out',
                        'bounce-slow': 'bounce 3s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'spin-slow': 'spin 20s linear infinite',
                        'wiggle': 'wiggle 1s ease-in-out infinite',
                        'gradient': 'gradient 8s ease infinite',
                        'shimmer': 'shimmer 2s linear infinite',
                        'scale-up': 'scaleUp 0.3s ease-out',
                        'slide-in-right': 'slideInRight 0.5s ease-out',
                        'slide-in-left': 'slideInLeft 0.5s ease-out',
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        slideUp: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        },
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        wiggle: {
                            '0%, 100%': { transform: 'rotate(-3deg)' },
                            '50%': { transform: 'rotate(3deg)' },
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        },
                        shimmer: {
                            '0%': { backgroundPosition: '-200% 0' },
                            '100%': { backgroundPosition: '200% 0' },
                        },
                        scaleUp: {
                            '0%': { transform: 'scale(0.95)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        slideInRight: {
                            '0%': { transform: 'translateX(20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        slideInLeft: {
                            '0%': { transform: 'translateX(-20px)', opacity: '0' },
                            '100%': { transform: 'translateX(0)', opacity: '1' },
                        },
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
                        },
                    },
                },
            },
        }
    </script>
    
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    {{-- Custom Styles - Clean Design --}}
    <style>
        [x-cloak] { display: none !important; }
        
        /* Clean Card Style */
        .glass {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(229, 231, 235, 0.8);
        }
        
        .dark .glass {
            background: rgba(31, 41, 55, 0.8);
            border: 1px solid rgba(75, 85, 99, 0.3);
        }
        
        .glass-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            transition: all 0.2s ease;
        }
        
        .dark .glass-card {
            background: #1f2937;
            border-color: #374151;
        }
        
        .glass-card:hover {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.1);
            border-color: #6366f1;
        }
        
        .dark .glass-card:hover {
            box-shadow: 0 10px 40px -10px rgba(0, 0, 0, 0.3);
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Clean Background */
        .mesh-gradient {
            background-color: #f9fafb;
        }
        
        .dark .mesh-gradient {
            background-color: #111827;
        }
        
        /* Bento Card */
        .bento-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            transition: all 0.3s ease;
        }
        
        .dark .bento-card {
            background: #1f2937;
            border-color: #374151;
        }
        
        .bento-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.1);
            border-color: #6366f1;
        }
        
        .dark .bento-card:hover {
            box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.4);
        }
        
        /* Button Styles */
        .btn-primary {
            background: #6366f1;
            color: white;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background: #4f46e5;
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }
        
        .btn-outline {
            background: transparent;
            border: 2px solid #e5e7eb;
            transition: all 0.2s ease;
        }
        
        .dark .btn-outline {
            border-color: #374151;
        }
        
        .btn-outline:hover {
            border-color: #6366f1;
            color: #6366f1;
        }
        
        /* Smooth Scroll */
        html {
            scroll-behavior: smooth;
        }
        
        /* Clean Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        .dark ::-webkit-scrollbar-track {
            background: #1f2937;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #6366f1;
        }
        
        .dark ::-webkit-scrollbar-thumb {
            background: #4b5563;
        }
        
        /* Hover Effects */
        .hover-lift {
            transition: all 0.2s ease;
        }
        
        .hover-lift:hover {
            transform: translateY(-2px);
        }
        
        /* Tag Pills */
        .tag-pill {
            background: #eef2ff;
            color: #4f46e5;
            padding: 4px 12px;
            border-radius: 9999px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .dark .tag-pill {
            background: rgba(99, 102, 241, 0.2);
            color: #a5b4fc;
        }
        
        /* Skill Bar */
        .skill-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 4px;
            overflow: hidden;
        }
        
        .dark .skill-bar {
            background: #374151;
        }
        
        .skill-bar-fill {
            height: 100%;
            background: #6366f1;
            border-radius: 4px;
            transition: width 1s ease;
        }
        
        /* Navigation Link */
        .nav-link {
            color: #6b7280;
            transition: color 0.2s ease;
        }
        
        .nav-link:hover,
        .nav-link.active {
            color: #6366f1;
        }
        
        .dark .nav-link {
            color: #9ca3af;
        }
        
        .dark .nav-link:hover,
        .dark .nav-link.active {
            color: #a5b4fc;
        }
        
        /* ====== ANIMATION EFFECTS ====== */
        
        /* Gradient Text Animation */
        .animate-gradient-text {
            background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899, #6366f1);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: gradientMove 8s ease infinite;
        }
        
        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        /* Shimmer Effect */
        .shimmer {
            position: relative;
            overflow: hidden;
        }
        
        .shimmer::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            animation: shimmerMove 2.5s ease-in-out infinite;
        }
        
        @keyframes shimmerMove {
            0% { left: -100%; }
            100% { left: 100%; }
        }
        
        /* Glow Effect */
        .glow-on-hover {
            transition: all 0.3s ease;
        }
        
        .glow-on-hover:hover {
            box-shadow: 0 0 30px rgba(99, 102, 241, 0.5);
        }
        
        /* Magnetic Button Effect */
        .magnetic-btn {
            transition: transform 0.3s cubic-bezier(0.23, 1, 0.32, 1);
        }
        
        .magnetic-btn:hover {
            transform: scale(1.05);
        }
        
        .magnetic-btn:active {
            transform: scale(0.95);
        }
        
        /* Card Tilt on Hover */
        .tilt-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            transform-style: preserve-3d;
        }
        
        .tilt-card:hover {
            transform: perspective(1000px) rotateX(2deg) rotateY(-2deg) scale(1.02);
        }
        
        /* Underline Animation */
        .hover-underline {
            position: relative;
        }
        
        .hover-underline::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: #6366f1;
            transition: width 0.3s ease;
        }
        
        .hover-underline:hover::after {
            width: 100%;
        }
        
        /* Pulse Ring Animation */
        .pulse-ring {
            position: relative;
        }
        
        .pulse-ring::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: inherit;
            border: 2px solid #6366f1;
            opacity: 0;
            animation: pulseRing 2s ease-out infinite;
        }
        
        @keyframes pulseRing {
            0% { transform: scale(0.8); opacity: 0; }
            50% { opacity: 0.5; }
            100% { transform: scale(1.2); opacity: 0; }
        }
        
        /* Floating Elements */
        .floating {
            animation: floatAnimation 6s ease-in-out infinite;
        }
        
        .floating-delayed {
            animation: floatAnimation 6s ease-in-out infinite;
            animation-delay: 2s;
        }
        
        @keyframes floatAnimation {
            0%, 100% { 
                transform: translateY(0px) translateX(0px); 
                opacity: 0.4;
            }
            25% { 
                transform: translateY(-15px) translateX(5px); 
                opacity: 0.6;
            }
            50% { 
                transform: translateY(-8px) translateX(-5px); 
                opacity: 0.5;
            }
            75% { 
                transform: translateY(-20px) translateX(3px); 
                opacity: 0.7;
            }
        }
        
        /* Icon Bounce on Hover */
        .icon-bounce:hover {
            animation: iconBounce 0.5s ease;
        }
        
        @keyframes iconBounce {
            0%, 100% { transform: translateY(0); }
            25% { transform: translateY(-8px); }
            50% { transform: translateY(-4px); }
            75% { transform: translateY(-6px); }
        }
        
        /* Text Reveal Animation */
        .text-reveal {
            opacity: 0;
            transform: translateY(20px);
            animation: textReveal 0.8s ease forwards;
        }
        
        .text-reveal:nth-child(1) { animation-delay: 0.1s; }
        .text-reveal:nth-child(2) { animation-delay: 0.2s; }
        .text-reveal:nth-child(3) { animation-delay: 0.3s; }
        .text-reveal:nth-child(4) { animation-delay: 0.4s; }
        
        @keyframes textReveal {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Border Gradient Animation */
        .border-gradient {
            position: relative;
            background: white;
            border-radius: 1rem;
        }
        
        .dark .border-gradient {
            background: #1f2937;
        }
        
        .border-gradient::before {
            content: '';
            position: absolute;
            inset: -2px;
            background: linear-gradient(90deg, #6366f1, #8b5cf6, #ec4899, #6366f1);
            background-size: 300% 300%;
            border-radius: inherit;
            z-index: -1;
            animation: gradient 4s ease infinite;
        }
        
        /* Typing Cursor */
        .typing-cursor::after {
            content: '|';
            animation: blink 1s step-end infinite;
        }
        
        @keyframes blink {
            0%, 100% { opacity: 1; }
            50% { opacity: 0; }
        }
        
        /* Staggered Fade In */
        .stagger-fade > * {
            opacity: 0;
            animation: fadeInUp 0.5s ease forwards;
        }
        
        .stagger-fade > *:nth-child(1) { animation-delay: 0.1s; }
        .stagger-fade > *:nth-child(2) { animation-delay: 0.2s; }
        .stagger-fade > *:nth-child(3) { animation-delay: 0.3s; }
        .stagger-fade > *:nth-child(4) { animation-delay: 0.4s; }
        .stagger-fade > *:nth-child(5) { animation-delay: 0.5s; }
        .stagger-fade > *:nth-child(6) { animation-delay: 0.6s; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Image Zoom on Hover */
        .img-zoom {
            overflow: hidden;
        }
        
        .img-zoom img {
            transition: transform 0.5s ease;
        }
        
        .img-zoom:hover img {
            transform: scale(1.1);
        }
        
        /* Blob Background */
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: blobMove 7s ease-in-out infinite;
            z-index: 0;
        }
        
        .blob-1 {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            width: 400px;
            height: 400px;
            top: 5%;
            left: 5%;
        }
        
        .blob-2 {
            background: linear-gradient(135deg, #8b5cf6, #a78bfa);
            width: 350px;
            height: 350px;
            top: 50%;
            right: 5%;
            animation-delay: 2s;
        }
        
        .blob-3 {
            background: linear-gradient(135deg, #6366f1, #818cf8);
            width: 300px;
            height: 300px;
            bottom: 10%;
            left: 25%;
            animation-delay: 4s;
        }
        
        @keyframes blobMove {
            0%, 100% { 
                transform: translate(0px, 0px) scale(1); 
                border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
            }
            25% { 
                transform: translate(20px, -30px) scale(1.05); 
                border-radius: 30% 60% 70% 40% / 50% 60% 30% 60%;
            }
            50% { 
                transform: translate(-20px, 20px) scale(0.95); 
                border-radius: 50% 60% 30% 60% / 30% 40% 70% 50%;
            }
            75% { 
                transform: translate(30px, 10px) scale(1.02); 
                border-radius: 40% 50% 60% 50% / 60% 30% 40% 70%;
            }
        }
        
        .dark .blob {
            opacity: 0.3;
        }
        
        /* Ripple Effect Button */
        .ripple {
            position: relative;
            overflow: hidden;
        }
        
        .ripple::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            background-image: radial-gradient(circle, #fff 10%, transparent 10%);
            background-repeat: no-repeat;
            background-position: 50%;
            transform: scale(10);
            opacity: 0;
            transition: transform 0.5s, opacity 0.5s;
        }
        
        .ripple:active::after {
            transform: scale(0);
            opacity: 0.3;
            transition: 0s;
        }
        
        /* Parallax Container */
        .parallax-container {
            perspective: 1px;
            overflow-x: hidden;
            overflow-y: auto;
        }
        
        /* Spin Slow for Decorative Elements */
        .spin-slow {
            animation: spin 20s linear infinite;
        }
        
        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }
        
        /* Scale Animation */
        .scale-on-hover {
            transition: transform 0.3s ease;
        }
        
        .scale-on-hover:hover {
            transform: scale(1.05);
        }
        
        /* Slide In from Sides */
        .slide-in-left {
            animation: slideInLeft 0.5s ease-out;
        }
        
        .slide-in-right {
            animation: slideInRight 0.5s ease-out;
        }
        
        @keyframes slideInLeft {
            from { transform: translateX(-50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideInRight {
            from { transform: translateX(50px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 min-h-screen text-gray-900 dark:text-gray-100">
    {{-- Navigation --}}
    @include('partials.navigation')
    
    {{-- Main Content --}}
    <main>
        @yield('content')
    </main>
    
    {{-- Footer --}}
    @include('partials.footer')
    
    {{-- Back to Top Button --}}
    <button 
        x-data="{ show: false }"
        x-init="window.addEventListener('scroll', () => { show = window.scrollY > 500 })"
        x-show="show"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="fixed bottom-8 right-8 z-50 p-4 rounded-2xl btn-primary text-white shadow-lg group"
        aria-label="Back to top"
    >
        <span class="relative z-10">
            <svg class="w-6 h-6 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
            </svg>
        </span>
    </button>
    
    {{-- AOS Animation Init --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50,
            anchorPlacement: 'top-bottom',
        });
        
        // Parallax effect on scroll
        document.addEventListener('scroll', function() {
            const parallaxElements = document.querySelectorAll('.parallax');
            parallaxElements.forEach(el => {
                const speed = el.dataset.speed || 0.5;
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight && rect.bottom > 0) {
                    const yPos = (window.scrollY - el.offsetTop) * speed;
                    el.style.transform = `translateY(${yPos}px)`;
                }
            });
        });
        
        // Mouse move effect for floating elements
        document.addEventListener('mousemove', function(e) {
            const moveElements = document.querySelectorAll('.mouse-move');
            const x = (e.clientX / window.innerWidth - 0.5) * 2;
            const y = (e.clientY / window.innerHeight - 0.5) * 2;
            
            moveElements.forEach(el => {
                const speed = el.dataset.speed || 20;
                el.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
            });
        });
        
        // Intersection Observer for custom animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-visible');
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.animate-on-scroll').forEach(el => {
            observer.observe(el);
        });
    </script>
    
    @stack('scripts')
</body>
</html>
