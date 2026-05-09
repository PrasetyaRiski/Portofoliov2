{{-- Footer - Modern 2026 Design --}}
<footer class="relative mt-24 overflow-hidden">
    {{-- Gradient Background --}}
    <div class="absolute inset-0 bg-gradient-to-b from-transparent via-gray-900/50 to-gray-900"></div>
    
    {{-- Decorative Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-indigo-500/10 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative">
        {{-- Main Footer Content --}}
        <div class="backdrop-blur-xl bg-gray-900/90 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-8">
                    {{-- Brand --}}
                    <div class="lg:col-span-2">
                        <a href="{{ route('home') }}" class="inline-flex items-center mb-6 group">
                            <span class="font-display font-bold text-4xl gradient-text-static">PR</span>
                            <span class="ml-1 w-2 h-2 rounded-full bg-primary-500 group-hover:animate-ping"></span>
                        </a>
                        <p class="text-gray-400 max-w-md leading-relaxed mb-8 text-lg">
                            {{ config('portfolio.owner.bio') }}
                        </p>
                        
                        {{-- Social Links --}}
                        <div class="flex items-center gap-3">
                            @if(config('portfolio.social.github'))
                            <a href="{{ config('portfolio.social.github') }}" target="_blank" rel="noopener" class="w-12 h-12 rounded-2xl bg-white/5 hover:bg-indigo-500/20 border border-white/10 hover:border-indigo-500/50 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:-translate-y-1 group">
                                <i class="fab fa-github text-xl text-gray-400 group-hover:text-white"></i>
                            </a>
                            @endif
                            @if(config('portfolio.social.instagram'))
                            <a href="{{ config('portfolio.social.instagram') }}" target="_blank" rel="noopener" class="w-12 h-12 rounded-2xl bg-white/5 hover:bg-indigo-500/20 border border-white/10 hover:border-indigo-500/50 flex items-center justify-center transition-all duration-300 hover:scale-110 hover:-translate-y-1 group">
                                <i class="fab fa-instagram text-xl text-gray-400 group-hover:text-white"></i>
                            </a>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Quick Links --}}
                    <div>
                        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                            <span class="w-8 h-0.5 bg-indigo-500 rounded-full"></span>
                            Quick Links
                        </h3>
                        <ul class="space-y-4">
                            <li>
                                <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-all duration-300 inline-flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-2 text-primary-500 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('home') }}#about" class="text-gray-400 hover:text-white transition-all duration-300 inline-flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-2 text-primary-500 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    About
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('projects.index') }}" class="text-gray-400 hover:text-white transition-all duration-300 inline-flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-2 text-primary-500 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    Projects
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('certificates.index') }}" class="text-gray-400 hover:text-white transition-all duration-300 inline-flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-2 text-primary-500 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    Certificates
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('contact.index') }}" class="text-gray-400 hover:text-white transition-all duration-300 inline-flex items-center group">
                                    <i class="fas fa-chevron-right text-xs mr-2 text-primary-500 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                                    Contact
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    {{-- Contact Info --}}
                    <div>
                        <h3 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                            <span class="w-8 h-0.5 bg-indigo-500 rounded-full"></span>
                            Get in Touch
                        </h3>
                        <ul class="space-y-5">
                            <li class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-xl bg-indigo-500/20 border border-indigo-500/20 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-indigo-400"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Email</p>
                                    <a href="mailto:{{ config('portfolio.owner.email') }}" class="text-white hover:text-primary-400 transition-colors text-sm">
                                        {{ config('portfolio.owner.email') }}
                                    </a>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-xl bg-indigo-500/20 border border-indigo-500/20 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone text-indigo-400"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Phone</p>
                                    <a href="tel:{{ config('portfolio.owner.phone') }}" class="text-white hover:text-primary-400 transition-colors text-sm">
                                        {{ config('portfolio.owner.phone') }}
                                    </a>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-11 h-11 rounded-xl bg-indigo-500/20 border border-indigo-500/20 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-indigo-400"></i>
                                </div>
                                <div>
                                    <p class="text-gray-500 text-xs uppercase tracking-wider mb-1">Location</p>
                                    <p class="text-white text-sm">Ponorogo, Indonesia</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Bottom Bar --}}
        <div class="bg-gray-950 border-t border-white/5">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                    <p class="text-gray-500 text-sm text-center sm:text-left">
                        &copy; {{ date('Y') }} <span class="text-white font-medium">{{ config('portfolio.owner.name') }}</span>. All rights reserved.
                    </p>
                    <p class="text-gray-600 text-sm flex items-center gap-2">
                        Crafted with <span class="text-red-500">❤</span> using 
                        <span class="text-indigo-400 font-semibold">Laravel</span> & 
                        <span class="text-slate-400 font-semibold">Tailwind</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
