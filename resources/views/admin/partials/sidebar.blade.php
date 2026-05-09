{{-- Mobile Sidebar Backdrop --}}
<div 
    x-show="sidebarOpen" 
    @click="sidebarOpen = false"
    class="fixed inset-0 z-40 bg-black/50 lg:hidden"
    x-transition:enter="transition-opacity ease-linear duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition-opacity ease-linear duration-300"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    x-cloak
></div>

{{-- Sidebar --}}
<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white/80 dark:bg-gray-900/90 backdrop-blur-xl border-r border-gray-200/50 dark:border-gray-700/50 transition-transform duration-300 ease-in-out"
>
    {{-- Logo --}}
    <div class="flex items-center justify-between h-20 px-6 border-b border-gray-200/50 dark:border-gray-700/50">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
            <span class="font-bold text-2xl tracking-tight">
                <span class="gradient-text">PR</span>
            </span>
            <span class="w-2 h-2 rounded-full bg-indigo-500 animate-pulse"></span>
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Admin</span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden text-gray-500 hover:text-gray-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
    
    {{-- Navigation --}}
    <nav class="p-4 space-y-2 overflow-y-auto h-[calc(100vh-5rem)]">
        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-home w-5 text-center"></i>
            <span>Dashboard</span>
        </a>
        
        {{-- Content Management --}}
        <div class="pt-6 pb-2">
            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                Content
            </p>
        </div>
        
        <a href="{{ route('admin.projects.index') }}" class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-folder-open w-5 text-center"></i>
            <span>Projects</span>
        </a>
        
        <a href="{{ route('admin.certificates.index') }}" class="sidebar-link {{ request()->routeIs('admin.certificates.*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-certificate w-5 text-center"></i>
            <span>Certificates</span>
        </a>
        
        <a href="{{ route('admin.skills.index') }}" class="sidebar-link {{ request()->routeIs('admin.skills.*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-code w-5 text-center"></i>
            <span>Skills</span>
        </a>
        
        {{-- Messages --}}
        <div class="pt-6 pb-2">
            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                Communication
            </p>
        </div>
        
        <a href="{{ route('admin.contacts.index') }}" class="sidebar-link {{ request()->routeIs('admin.contacts.*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-envelope w-5 text-center"></i>
            <span>Messages</span>
            @php
                $unreadCount = \App\Models\Contact::unread()->count();
            @endphp
            @if($unreadCount > 0)
            <span class="ml-auto bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                {{ $unreadCount }}
            </span>
            @endif
        </a>
        
        {{-- Quick Links --}}
        <div class="pt-6 pb-2">
            <p class="px-4 text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                Quick Links
            </p>
        </div>
        
        <a href="{{ route('admin.settings.index') }}" class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'sidebar-link-active' : '' }}">
            <i class="fas fa-cog w-5 text-center"></i>
            <span>Settings</span>
        </a>
        
        <a href="{{ route('home') }}" target="_blank" class="sidebar-link">
            <i class="fas fa-external-link-alt w-5 text-center"></i>
            <span>View Website</span>
        </a>
        
        {{-- Logout --}}
        <div class="pt-4 mt-4 border-t border-gray-200 dark:border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left text-red-500 hover:bg-red-50 dark:hover:bg-red-900/20">
                    <i class="fas fa-sign-out-alt w-5 text-center"></i>
                    <span>Logout</span>
                </button>
            </form>
        </div>
    </nav>
</aside>

<style>
    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 0.75rem;
        color: #6b7280;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }
    
    .sidebar-link:hover {
        background-color: #f3f4f6;
        color: #111827;
    }
    
    .dark .sidebar-link {
        color: #9ca3af;
    }
    
    .dark .sidebar-link:hover {
        background-color: #1f2937;
        color: #f9fafb;
    }
    
    .sidebar-link-active {
        background-color: #eef2ff;
        color: #4f46e5;
        font-weight: 600;
    }
    
    .dark .sidebar-link-active {
        background-color: rgba(79, 70, 229, 0.2);
        color: #818cf8;
    }
</style>
