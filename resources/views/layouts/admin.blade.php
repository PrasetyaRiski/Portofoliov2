<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ sidebarOpen: false, darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Admin Dashboard') - {{ config('app.name') }}</title>
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
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
                },
            },
        }
    </script>
    
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #4f46e5 0%, #6366f1 50%, #818cf8 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
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
            transform: translateY(-2px);
            box-shadow: 0 10px 40px -15px rgba(99, 102, 241, 0.15);
            border-color: #6366f1;
        }
        
        /* Button Primary */
        .btn-primary {
            background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
            color: white;
            transition: all 0.2s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #4f46e5 0%, #4338ca 100%);
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);
        }
        
        /* Clean Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        
        .dark ::-webkit-scrollbar-track {
            background: #1f2937;
        }
        
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: #6366f1;
        }
        
        .dark ::-webkit-scrollbar-thumb {
            background: #4b5563;
        }
        
        /* Stats Card Gradient */
        .stats-card {
            position: relative;
            overflow: hidden;
        }
        
        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, transparent 100%);
            border-radius: 0 0 0 100%;
        }
    </style>
    
    @stack('styles')
</head>
<body class="font-sans antialiased bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <div class="min-h-screen flex">
        {{-- Sidebar --}}
        @include('admin.partials.sidebar')
        
        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-h-screen lg:ml-64">
            {{-- Top Navigation --}}
            @include('admin.partials.topnav')
            
            {{-- Page Content --}}
            <main class="flex-1 p-4 lg:p-8">
                {{-- Flash Messages --}}
                @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 flex items-center gap-3" x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)">
                    <i class="fas fa-check-circle text-xl"></i>
                    <span>{{ session('success') }}</span>
                    <button @click="show = false" class="ml-auto">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                
                @if(session('error'))
                <div class="mb-6 p-4 rounded-xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 flex items-center gap-3" x-data="{ show: true }" x-show="show">
                    <i class="fas fa-exclamation-circle text-xl"></i>
                    <span>{{ session('error') }}</span>
                    <button @click="show = false" class="ml-auto">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                @endif
                
                @yield('content')
            </main>
            
            {{-- Footer --}}
            <footer class="border-t border-gray-200 dark:border-gray-800 py-4 px-8">
                <p class="text-sm text-gray-500 dark:text-gray-400 text-center">
                    &copy; {{ date('Y') }} Portfolio Admin. Built with Laravel & Tailwind CSS.
                </p>
            </footer>
        </div>
    </div>
    
    @stack('scripts')
</body>
</html>
