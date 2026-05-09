@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Welcome Banner --}}
<div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-indigo-500 to-purple-600 rounded-3xl p-8 lg:p-10 text-white mb-8">
    {{-- Decorative elements --}}
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/10 rounded-full translate-y-1/2 -translate-x-1/2"></div>
    
    <div class="relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        <div>
            <p class="text-indigo-200 text-sm font-medium mb-2">{{ now()->format('l, d F Y') }}</p>
            <h2 class="text-3xl lg:text-4xl font-bold mb-3">Selamat datang, {{ auth()->user()->name }}! 👋</h2>
            <p class="text-white/80 text-lg">Kelola portfolio Anda dengan mudah dari dashboard ini.</p>
        </div>
        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center px-8 py-4 bg-white text-indigo-600 rounded-2xl font-bold hover:bg-gray-100 transition-all hover:scale-105 shadow-lg">
            <i class="fas fa-plus mr-3"></i>
            Tambah Project
        </a>
    </div>
</div>

{{-- Stats Grid --}}
<div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Projects Stats --}}
    <div class="bento-card stats-card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-lg shadow-blue-500/30">
                <i class="fas fa-folder-open text-xl text-white"></i>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1.5 rounded-full">
                {{ $stats['projects']['published'] }} Published
            </span>
        </div>
        <h3 class="text-4xl font-bold mb-1 gradient-text">{{ $stats['projects']['total'] }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total Projects</p>
        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
            <div class="flex items-center justify-between text-sm">
                <span class="text-gray-500 dark:text-gray-400">Total Views</span>
                <span class="font-bold text-gray-900 dark:text-white">{{ number_format($stats['projects']['views']) }}</span>
            </div>
        </div>
    </div>
    
    {{-- Certificates Stats --}}
    <div class="bento-card stats-card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center shadow-lg shadow-purple-500/30">
                <i class="fas fa-certificate text-xl text-white"></i>
            </div>
            <span class="text-xs font-semibold text-emerald-600 bg-emerald-100 dark:bg-emerald-900/30 px-3 py-1.5 rounded-full">
                {{ $stats['certificates']['verified'] }} Verified
            </span>
        </div>
        <h3 class="text-4xl font-bold mb-1 gradient-text">{{ $stats['certificates']['total'] }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total Certificates</p>
        @if($stats['certificates']['expiring'] > 0)
        <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
            <div class="flex items-center text-sm text-amber-600 dark:text-amber-400">
                <i class="fas fa-exclamation-triangle mr-2"></i>
                <span>{{ $stats['certificates']['expiring'] }} expiring soon</span>
            </div>
        </div>
        @endif
    </div>
    
    {{-- Skills Stats --}}
    <div class="bento-card stats-card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-500/30">
                <i class="fas fa-code text-xl text-white"></i>
            </div>
            <span class="text-xs font-semibold text-indigo-600 bg-indigo-100 dark:bg-indigo-900/30 px-3 py-1.5 rounded-full">
                {{ $stats['skills']['featured'] }} Featured
            </span>
        </div>
        <h3 class="text-4xl font-bold mb-1 gradient-text">{{ $stats['skills']['total'] }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total Skills</p>
    </div>
    
    {{-- Messages Stats --}}
    <div class="bento-card stats-card p-6">
        <div class="flex items-center justify-between mb-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-rose-500 to-rose-600 flex items-center justify-center shadow-lg shadow-rose-500/30">
                <i class="fas fa-envelope text-xl text-white"></i>
            </div>
            @if($stats['contacts']['unread'] > 0)
            <span class="text-xs font-semibold text-rose-600 bg-rose-100 dark:bg-rose-900/30 px-3 py-1.5 rounded-full animate-pulse">
                {{ $stats['contacts']['unread'] }} Unread
            </span>
            @endif
        </div>
        <h3 class="text-4xl font-bold mb-1 gradient-text">{{ $stats['contacts']['total'] }}</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400 font-medium">Total Messages</p>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-8">
    {{-- Recent Projects --}}
    <div class="bento-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <h3 class="text-lg font-bold">Project Terbaru</h3>
            <a href="{{ route('admin.projects.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            @forelse($recentProjects as $project)
            <a href="{{ route('admin.projects.edit', $project) }}" class="flex items-center gap-4 p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                    @if($project->featured_image_url)
                    <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover rounded-lg">
                    @else
                    <i class="fas fa-folder text-white"></i>
                    @endif
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-medium truncate">{{ $project->title }}</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $project->category_label }}</p>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $project->status_color }}-100 dark:bg-{{ $project->status_color }}-900/30 text-{{ $project->status_color }}-600 dark:text-{{ $project->status_color }}-400">
                    {{ $project->status_label }}
                </span>
            </a>
            @empty
            <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                <i class="fas fa-folder-open text-3xl mb-2"></i>
                <p>Belum ada project</p>
            </div>
            @endforelse
        </div>
    </div>
    
    {{-- Recent Messages --}}
    <div class="bento-card overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
            <h3 class="text-lg font-bold">Pesan Terbaru</h3>
            <a href="{{ route('admin.contacts.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Lihat Semua →</a>
        </div>
        <div class="divide-y divide-gray-100 dark:divide-gray-700">
            @forelse($recentContacts as $contact)
            <a href="{{ route('admin.contacts.show', $contact) }}" class="flex items-center gap-4 p-4 hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-colors {{ $contact->is_unread ? 'bg-indigo-50/50 dark:bg-indigo-900/10' : '' }}">
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-800 flex items-center justify-center flex-shrink-0">
                    <span class="text-lg font-bold text-gray-600 dark:text-gray-300">{{ substr($contact->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-semibold truncate {{ $contact->is_unread ? 'text-indigo-600 dark:text-indigo-400' : '' }}">
                        {{ $contact->name }}
                    </h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $contact->subject ?? Str::limit($contact->message, 50) }}</p>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-xs text-gray-400">{{ $contact->created_at->diffForHumans() }}</p>
                    @if($contact->is_unread)
                    <span class="inline-block w-2 h-2 bg-indigo-500 rounded-full mt-1 animate-pulse"></span>
                    @endif
                </div>
            </a>
            @empty
            <div class="p-8 text-center text-gray-500 dark:text-gray-400">
                <i class="fas fa-envelope text-3xl mb-2"></i>
                <p>Belum ada pesan</p>
            </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Top Performing Projects --}}
@if($topProjects->count() > 0)
<div class="mt-8 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    <div class="p-6 border-b border-gray-200 dark:border-gray-700">
        <h3 class="text-lg font-semibold">Top Performing Projects</h3>
        <p class="text-sm text-gray-500 dark:text-gray-400">Based on view count</p>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Project</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Views</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($topProjects as $project)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                                @if($project->featured_image_url)
                                <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover rounded-lg">
                                @else
                                <i class="fas fa-folder text-white text-sm"></i>
                                @endif
                            </div>
                            <span class="font-medium">{{ $project->title }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">{{ $project->category_label }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-eye text-gray-400"></i>
                            <span class="font-semibold">{{ number_format($project->views_count) }}</span>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $project->status_color }}-100 dark:bg-{{ $project->status_color }}-900/30 text-{{ $project->status_color }}-600 dark:text-{{ $project->status_color }}-400">
                            {{ $project->status_label }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
