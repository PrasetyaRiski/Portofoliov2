{{-- Navigation - Modern 2026 Design --}}
<nav x-data="{ mobileOpen: false, scrolled: false }" 
     x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
     :class="{ 'bg-white/70 dark:bg-gray-900/70 shadow-lg shadow-gray-200/20 dark:shadow-gray-900/30 backdrop-blur-2xl border-b border-white/20': scrolled, 'bg-transparent': !scrolled }"
     class="fixed top-0 left-0 right-0 z-50 transition-all duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center group">
                <span class="font-display font-bold text-3xl tracking-tight">
                    <span class="gradient-text-static">PR</span>
                </span>
                <span class="ml-1 w-2 h-2 rounded-full bg-primary-500 group-hover:animate-ping"></span>
            </a>
            
            {{-- Desktop Navigation --}}
            <div class="hidden lg:flex items-center space-x-6">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'nav-link-active' : '' }}">
                    Home
                </a>
                <a href="{{ route('home') }}#about" class="nav-link">
                    About
                </a>
                <a href="{{ route('projects.index') }}" class="nav-link {{ request()->routeIs('projects.*') ? 'nav-link-active' : '' }}">
                    Projects
                </a>
                <a href="{{ route('certificates.index') }}" class="nav-link {{ request()->routeIs('certificates.*') ? 'nav-link-active' : '' }}">
                    Certificates
                </a>
                <a href="{{ route('home') }}#skills" class="nav-link">
                    Skills
                </a>
                <a href="{{ route('contact.index') }}" class="nav-link {{ request()->routeIs('contact.*') ? 'nav-link-active' : '' }}">
                    Contact
                </a>
            </div>
            
            {{-- Right Side Actions --}}
            <div class="flex items-center space-x-3">
                {{-- Dark Mode Toggle --}}
                <button 
                    @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                    class="p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                    aria-label="Toggle dark mode"
                >
                    <svg x-show="!darkMode" class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg x-show="darkMode" x-cloak class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </button>
                
                {{-- CTA Button (Desktop) --}}
                <a href="{{ route('contact.index') }}" class="hidden lg:inline-flex items-center px-6 py-3 rounded-2xl btn-primary text-white font-semibold text-sm group overflow-hidden">
                    <span class="relative z-10 flex items-center">
                        <span>Let's Talk</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </span>
                </a>
                
                {{-- Mobile Menu Button --}}
                <button 
                    @click="mobileOpen = !mobileOpen"
                    class="lg:hidden p-2 rounded-xl hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors"
                    aria-label="Toggle mobile menu"
                >
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    {{-- Mobile Menu --}}
    <div 
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 -translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-4"
        @click.away="mobileOpen = false"
        class="lg:hidden absolute top-full left-0 right-0 bg-white/95 dark:bg-gray-900/95 backdrop-blur-lg shadow-xl border-t border-gray-100 dark:border-gray-800"
        x-cloak
    >
        <div class="max-w-7xl mx-auto px-4 py-4 space-y-1">
            <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'mobile-nav-link-active' : '' }}">
                <i class="fas fa-home w-5"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('home') }}#about" @click="mobileOpen = false" class="mobile-nav-link">
                <i class="fas fa-user w-5"></i>
                <span>About</span>
            </a>
            <a href="{{ route('projects.index') }}" class="mobile-nav-link {{ request()->routeIs('projects.*') ? 'mobile-nav-link-active' : '' }}">
                <i class="fas fa-folder-open w-5"></i>
                <span>Projects</span>
            </a>
            <a href="{{ route('certificates.index') }}" class="mobile-nav-link {{ request()->routeIs('certificates.*') ? 'mobile-nav-link-active' : '' }}">
                <i class="fas fa-certificate w-5"></i>
                <span>Certificates</span>
            </a>
            <a href="{{ route('home') }}#skills" @click="mobileOpen = false" class="mobile-nav-link">
                <i class="fas fa-code w-5"></i>
                <span>Skills</span>
            </a>
            <a href="{{ route('contact.index') }}" class="mobile-nav-link {{ request()->routeIs('contact.*') ? 'mobile-nav-link-active' : '' }}">
                <i class="fas fa-envelope w-5"></i>
                <span>Contact</span>
            </a>
            
            <div class="pt-4 mt-4 border-t border-gray-100 dark:border-gray-800">
                <a href="{{ route('contact.index') }}" class="flex items-center justify-center w-full px-5 py-4 rounded-2xl btn-primary text-white font-semibold shadow-lg group overflow-hidden">
                    <span class="relative z-10 flex items-center">
                        <span>Let's Talk</span>
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</nav>
