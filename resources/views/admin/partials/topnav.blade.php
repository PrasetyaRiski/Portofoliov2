{{-- Top Navigation --}}
<header class="sticky top-0 z-30 bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-b border-gray-200/50 dark:border-gray-700/50">
    <div class="flex items-center justify-between h-20 px-4 lg:px-8">
        {{-- Left Side --}}
        <div class="flex items-center gap-4">
            {{-- Mobile Menu Button --}}
            <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                <i class="fas fa-bars text-gray-600 dark:text-gray-400"></i>
            </button>
            
            {{-- Page Title --}}
            <h1 class="text-lg font-semibold hidden sm:block">
                @yield('page-title', 'Dashboard')
            </h1>
        </div>
        
        {{-- Right Side --}}
        <div class="flex items-center gap-3">
            {{-- Dark Mode Toggle --}}
            <button 
                @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)"
                class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors"
            >
                <i x-show="!darkMode" class="fas fa-moon text-gray-600"></i>
                <i x-show="darkMode" x-cloak class="fas fa-sun text-yellow-400"></i>
            </button>
            
            {{-- Notifications --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors relative">
                    <i class="fas fa-bell text-gray-600 dark:text-gray-400"></i>
                    @if($unreadCount ?? 0 > 0)
                    <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                    @endif
                </button>
                
                {{-- Dropdown --}}
                <div 
                    x-show="open" 
                    @click.away="open = false"
                    x-transition
                    x-cloak
                    class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden"
                >
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <h3 class="font-semibold">Notifications</h3>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        @php
                            $recentMessages = \App\Models\Contact::unread()->latest()->take(5)->get();
                        @endphp
                        
                        @forelse($recentMessages as $message)
                        <a href="{{ route('admin.contacts.show', $message) }}" class="block p-4 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                            <div class="flex items-start gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-primary-600 dark:text-primary-400"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-sm truncate">{{ $message->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ $message->subject ?? 'No subject' }}</p>
                                    <p class="text-xs text-gray-400 mt-1">{{ $message->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                        @empty
                        <div class="p-4 text-center text-gray-500 dark:text-gray-400">
                            <i class="fas fa-inbox text-2xl mb-2"></i>
                            <p class="text-sm">No new notifications</p>
                        </div>
                        @endforelse
                    </div>
                    @if($recentMessages->count() > 0)
                    <a href="{{ route('admin.contacts.index') }}" class="block p-3 text-center text-sm text-primary-600 dark:text-primary-400 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors border-t border-gray-200 dark:border-gray-700">
                        View All Messages
                    </a>
                    @endif
                </div>
            </div>
            
            {{-- User Menu --}}
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <img src="{{ auth()->user()->avatar_url }}" alt="{{ auth()->user()->name }}" class="w-8 h-8 rounded-full object-cover">
                    <span class="hidden sm:block font-medium text-sm">{{ auth()->user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                </button>
                
                {{-- Dropdown --}}
                <div 
                    x-show="open" 
                    @click.away="open = false"
                    x-transition
                    x-cloak
                    class="absolute right-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden"
                >
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
                    </div>
                    
                    <div class="p-2">
                        <a href="{{ route('home') }}" target="_blank" class="flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <i class="fas fa-external-link-alt w-4 text-gray-400"></i>
                            <span class="text-sm">View Website</span>
                        </a>
                        
                        <hr class="my-2 border-gray-200 dark:border-gray-700">
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-3 py-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400 transition-colors">
                                <i class="fas fa-sign-out-alt w-4"></i>
                                <span class="text-sm">Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
