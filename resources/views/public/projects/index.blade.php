@extends('layouts.public')

@section('title', 'Projects - ' . config('portfolio.seo.title'))
@section('description', 'Browse my portfolio of projects including web applications, mobile apps, and more.')

@section('content')
{{-- Page Header --}}
<section class="relative pt-32 pb-16 overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute top-0 left-1/4 w-96 h-96 bg-primary-500/20 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-purple-500/20 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <span class="inline-block px-4 py-2 rounded-full bg-primary-100 dark:bg-primary-900/30 text-primary-600 dark:text-primary-400 text-sm font-semibold mb-4">
                My Work
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold mb-4">
                <span class="gradient-text">Projects</span>
            </h1>
            <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">
                A collection of projects I've worked on, showcasing my skills in web development, 
                mobile applications, and more.
            </p>
        </div>
    </div>
</section>

{{-- Filters Section --}}
<section class="sticky top-16 lg:top-20 z-40 py-4 bg-white/80 dark:bg-gray-900/80 backdrop-blur-lg border-b border-gray-200 dark:border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('projects.index') }}" class="flex flex-col sm:flex-row items-center gap-4" x-data>
            {{-- Search --}}
            <div class="relative flex-1 w-full">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search projects..."
                    class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-800 border-0 focus:ring-2 focus:ring-primary-500 transition-all"
                >
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
            </div>
            
            {{-- Category Filter --}}
            <select 
                name="category" 
                onchange="this.form.submit()"
                class="w-full sm:w-auto px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-800 border-0 focus:ring-2 focus:ring-primary-500 transition-all"
            >
                <option value="">All Categories</option>
                @foreach($categories as $key => $label)
                <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
                @endforeach
            </select>
            
            {{-- Technology Filter --}}
            @if($technologies->count() > 0)
            <select 
                name="tech" 
                onchange="this.form.submit()"
                class="w-full sm:w-auto px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-800 border-0 focus:ring-2 focus:ring-primary-500 transition-all"
            >
                <option value="">All Technologies</option>
                @foreach($technologies as $tech)
                <option value="{{ $tech }}" {{ request('tech') === $tech ? 'selected' : '' }}>
                    {{ $tech }}
                </option>
                @endforeach
            </select>
            @endif
            
            {{-- Search Button (for mobile) --}}
            <button type="submit" class="sm:hidden w-full px-6 py-3 rounded-xl bg-primary-500 text-white font-semibold hover:bg-primary-600 transition-colors">
                Search
            </button>
            
            {{-- Clear Filters --}}
            @if(request()->hasAny(['search', 'category', 'tech']))
            <a href="{{ route('projects.index') }}" class="text-gray-500 hover:text-primary-500 transition-colors">
                <i class="fas fa-times-circle"></i>
                <span class="sr-only">Clear filters</span>
            </a>
            @endif
        </form>
    </div>
</section>

{{-- Projects Grid --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @if($projects->count() > 0)
        {{-- Results Count --}}
        <p class="text-gray-500 dark:text-gray-400 mb-8">
            Showing {{ $projects->firstItem() ?? 0 }} - {{ $projects->lastItem() ?? 0 }} of {{ $projects->total() }} projects
        </p>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($projects as $project)
            <article class="group glass-card rounded-2xl overflow-hidden hover-lift" x-data x-intersect="$el.classList.add('animate-fade-in')">
                {{-- Project Image --}}
                <div class="relative aspect-video overflow-hidden bg-gradient-to-br from-primary-500 to-purple-600">
                    @if($project->featured_image_url)
                    <img 
                        src="{{ $project->featured_image_url }}" 
                        alt="{{ $project->title }}" 
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                        loading="lazy"
                    >
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-project-diagram text-4xl text-white/50"></i>
                    </div>
                    @endif
                    
                    {{-- Overlay with Links --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end">
                        <div class="p-4 w-full flex items-center justify-between">
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="px-4 py-2 rounded-lg bg-white/20 backdrop-blur-sm text-white text-sm hover:bg-white/30 transition-colors">
                                <i class="fas fa-external-link-alt mr-2"></i>Live Demo
                            </a>
                            @endif
                            @if($project->github_url)
                            <a href="{{ $project->github_url }}" target="_blank" class="px-4 py-2 rounded-lg bg-white/20 backdrop-blur-sm text-white text-sm hover:bg-white/30 transition-colors">
                                <i class="fab fa-github mr-2"></i>Source Code
                            </a>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Category Badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-full bg-white/90 dark:bg-gray-900/90 text-xs font-semibold text-primary-600 dark:text-primary-400 shadow-lg">
                            {{ $project->category_label }}
                        </span>
                    </div>
                    
                    {{-- Featured Badge --}}
                    @if($project->is_featured)
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full bg-yellow-500 text-white text-xs font-semibold shadow-lg">
                            <i class="fas fa-star mr-1"></i>Featured
                        </span>
                    </div>
                    @endif
                </div>
                
                {{-- Project Info --}}
                <div class="p-6">
                    <h2 class="text-xl font-bold mb-2 group-hover:text-primary-600 dark:group-hover:text-primary-400 transition-colors">
                        <a href="{{ route('projects.show', $project) }}" class="hover:underline">
                            {{ $project->title }}
                        </a>
                    </h2>
                    
                    <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 line-clamp-2">
                        {{ $project->short_description ?? Str::limit(strip_tags($project->description), 120) }}
                    </p>
                    
                    {{-- Technologies --}}
                    @if($project->technologies)
                    <div class="flex flex-wrap gap-2 mb-4">
                        @foreach(array_slice($project->technologies, 0, 4) as $tech)
                        <span class="px-2 py-1 rounded-md bg-gray-100 dark:bg-gray-800 text-xs text-gray-600 dark:text-gray-400">
                            {{ $tech }}
                        </span>
                        @endforeach
                        @if(count($project->technologies) > 4)
                        <span class="px-2 py-1 rounded-md bg-primary-100 dark:bg-primary-900/30 text-xs text-primary-600 dark:text-primary-400">
                            +{{ count($project->technologies) - 4 }} more
                        </span>
                        @endif
                    </div>
                    @endif
                    
                    {{-- Footer --}}
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-800">
                        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                            <i class="fas fa-eye mr-1"></i>
                            <span>{{ number_format($project->views_count) }} views</span>
                        </div>
                        <a href="{{ route('projects.show', $project) }}" class="text-sm font-semibold text-primary-600 dark:text-primary-400 hover:underline inline-flex items-center group/link">
                            View Details
                            <i class="fas fa-arrow-right ml-2 group-hover/link:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        {{-- Pagination --}}
        <div class="mt-12">
            {{ $projects->links() }}
        </div>
        
        @else
        {{-- No Results --}}
        <div class="text-center py-20">
            <div class="w-24 h-24 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-search text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-bold mb-2">No Projects Found</h3>
            <p class="text-gray-500 dark:text-gray-400 mb-6">
                @if(request()->hasAny(['search', 'category', 'tech']))
                    Try adjusting your search or filter criteria.
                @else
                    No projects have been added yet. Check back soon!
                @endif
            </p>
            @if(request()->hasAny(['search', 'category', 'tech']))
            <a href="{{ route('projects.index') }}" class="inline-flex items-center px-6 py-3 rounded-xl bg-primary-500 text-white font-semibold hover:bg-primary-600 transition-colors">
                <i class="fas fa-times mr-2"></i>
                Clear Filters
            </a>
            @endif
        </div>
        @endif
    </div>
</section>
@endsection
