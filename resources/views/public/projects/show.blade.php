@extends('layouts.public')

@section('title', $project->title . ' - ' . config('portfolio.seo.title'))
@section('description', $project->short_description ?? Str::limit(strip_tags($project->description), 160))
@section('og_image', $project->featured_image_url)

@section('content')
{{-- Hero Section --}}
<section class="relative pt-24 pb-12 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-8">
            <a href="{{ route('home') }}" class="hover:text-primary-500 transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('projects.index') }}" class="hover:text-primary-500 transition-colors">Projects</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 dark:text-gray-100">{{ $project->title }}</span>
        </nav>
        
        <div class="grid lg:grid-cols-3 gap-8">
            {{-- Main Content --}}
            <div class="lg:col-span-2 space-y-8">
                {{-- Featured Image --}}
                <div class="relative aspect-video rounded-2xl overflow-hidden bg-gradient-to-br from-primary-500 to-purple-600 shadow-2xl">
                    @if($project->featured_image_url)
                    <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-project-diagram text-6xl text-white/50"></i>
                    </div>
                    @endif
                    
                    {{-- Category Badge --}}
                    <span class="absolute top-4 left-4 px-4 py-2 rounded-full bg-white/90 dark:bg-gray-900/90 text-sm font-semibold text-primary-600 dark:text-primary-400 shadow-lg">
                        {{ $project->category_label }}
                    </span>
                    
                    @if($project->is_featured)
                    <span class="absolute top-4 right-4 px-4 py-2 rounded-full bg-yellow-500 text-white text-sm font-semibold shadow-lg">
                        <i class="fas fa-star mr-1"></i> Featured
                    </span>
                    @endif
                </div>
                
                {{-- Title & Meta --}}
                <div>
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-display font-bold mb-4">
                        {{ $project->title }}
                    </h1>
                    
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                        @if($project->duration)
                        <span class="flex items-center gap-2">
                            <i class="fas fa-calendar"></i>
                            {{ $project->duration }}
                        </span>
                        @endif
                        
                        @if($project->client)
                        <span class="flex items-center gap-2">
                            <i class="fas fa-building"></i>
                            {{ $project->client }}
                        </span>
                        @endif
                        
                        <span class="flex items-center gap-2">
                            <i class="fas fa-eye"></i>
                            {{ number_format($project->views_count) }} views
                        </span>
                    </div>
                </div>
                
                {{-- Description --}}
                <div class="glass-card rounded-2xl p-8">
                    <h2 class="text-xl font-bold mb-4">About This Project</h2>
                    <div class="prose prose-lg dark:prose-invert max-w-none">
                        {!! nl2br(e($project->description)) !!}
                    </div>
                </div>
                
                {{-- Gallery --}}
                @if($project->gallery_images && count($project->gallery_images) > 0)
                <div class="glass-card rounded-2xl p-8">
                    <h2 class="text-xl font-bold mb-4">Project Gallery</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4" x-data="{ lightbox: false, current: '' }">
                        @foreach($project->gallery_images_urls as $image)
                        <button 
                            @click="lightbox = true; current = '{{ $image }}'"
                            class="aspect-video rounded-xl overflow-hidden hover:ring-4 ring-primary-500 transition-all cursor-zoom-in"
                        >
                            <img src="{{ $image }}" alt="Gallery image" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                        
                        {{-- Lightbox --}}
                        <div 
                            x-show="lightbox" 
                            x-cloak
                            @click="lightbox = false"
                            @keydown.escape.window="lightbox = false"
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black/90 p-4"
                            x-transition
                        >
                            <button @click="lightbox = false" class="absolute top-4 right-4 text-white text-2xl hover:text-primary-400 transition-colors">
                                <i class="fas fa-times"></i>
                            </button>
                            <img :src="current" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
                        </div>
                    </div>
                </div>
                @endif
            </div>
            
            {{-- Sidebar --}}
            <div class="space-y-6">
                {{-- Action Buttons --}}
                <div class="glass-card rounded-2xl p-6 space-y-4">
                    @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-gradient-to-r from-primary-500 to-purple-600 text-white font-semibold hover:shadow-lg hover:shadow-primary-500/30 transition-all">
                        <i class="fas fa-external-link-alt"></i>
                        <span>View Live Demo</span>
                    </a>
                    @endif
                    
                    @if($project->github_url)
                    <a href="{{ $project->github_url }}" target="_blank" class="w-full flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-gray-900 dark:bg-gray-800 text-white font-semibold hover:bg-gray-800 dark:hover:bg-gray-700 transition-colors">
                        <i class="fab fa-github"></i>
                        <span>View Source Code</span>
                    </a>
                    @endif
                </div>
                
                {{-- Technologies --}}
                @if($project->technologies)
                <div class="glass-card rounded-2xl p-6">
                    <h3 class="text-lg font-bold mb-4">Technologies Used</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->technologies as $tech)
                        <span class="px-3 py-2 rounded-lg bg-gray-100 dark:bg-gray-800 text-sm font-medium text-gray-700 dark:text-gray-300">
                            {{ $tech }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
                
                {{-- Project Details --}}
                <div class="glass-card rounded-2xl p-6">
                    <h3 class="text-lg font-bold mb-4">Project Details</h3>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Category</dt>
                            <dd class="font-medium">{{ $project->category_label }}</dd>
                        </div>
                        
                        @if($project->start_date)
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Started</dt>
                            <dd class="font-medium">{{ $project->start_date->format('F Y') }}</dd>
                        </div>
                        @endif
                        
                        @if($project->end_date)
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Completed</dt>
                            <dd class="font-medium">{{ $project->end_date->format('F Y') }}</dd>
                        </div>
                        @endif
                        
                        @if($project->client)
                        <div>
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Client</dt>
                            <dd class="font-medium">{{ $project->client }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
                
                {{-- Share --}}
                <div class="glass-card rounded-2xl p-6">
                    <h3 class="text-lg font-bold mb-4">Share This Project</h3>
                    <div class="flex items-center gap-3">
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($project->title) }}" target="_blank" class="w-10 h-10 rounded-xl bg-sky-500 text-white flex items-center justify-center hover:bg-sky-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-10 h-10 rounded-xl bg-blue-500 text-white flex items-center justify-center hover:bg-blue-600 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <button 
                            onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('Link copied!');"
                            class="w-10 h-10 rounded-xl bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                        >
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Projects --}}
@if($relatedProjects->count() > 0)
<section class="py-16 bg-gray-50/50 dark:bg-gray-900/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold mb-8">Related Projects</h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedProjects as $related)
            <article class="group glass-card rounded-2xl overflow-hidden hover-lift">
                <div class="relative aspect-video overflow-hidden bg-gradient-to-br from-primary-500 to-purple-600">
                    @if($related->featured_image_url)
                    <img src="{{ $related->featured_image_url }}" alt="{{ $related->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-project-diagram text-4xl text-white/50"></i>
                    </div>
                    @endif
                </div>
                
                <div class="p-6">
                    <h3 class="text-lg font-bold mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                        <a href="{{ route('projects.show', $related) }}">{{ $related->title }}</a>
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm line-clamp-2">
                        {{ $related->short_description ?? Str::limit(strip_tags($related->description), 100) }}
                    </p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Back to Projects --}}
<section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <a href="{{ route('projects.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl border-2 border-primary-500 text-primary-600 dark:text-primary-400 font-semibold hover:bg-primary-500 hover:text-white transition-all">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to All Projects
        </a>
    </div>
</section>
@endsection
