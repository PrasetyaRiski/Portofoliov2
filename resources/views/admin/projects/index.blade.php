@extends('layouts.admin')

@section('title', 'Projects')
@section('page-title', 'Projects')

@section('content')
{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold">All Projects</h2>
        <p class="text-gray-500 dark:text-gray-400">Manage your portfolio projects</p>
    </div>
    <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors">
        <i class="fas fa-plus mr-2"></i>
        New Project
    </a>
</div>

{{-- Filters --}}
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-6">
    <form method="GET" action="{{ route('admin.projects.index') }}" class="flex flex-col sm:flex-row gap-4">
        <div class="flex-1">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}"
                placeholder="Search projects..."
                class="w-full px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
            >
        </div>
        <select name="status" class="px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500">
            <option value="">All Status</option>
            @foreach($statuses as $key => $label)
            <option value="{{ $key }}" {{ request('status') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <select name="category" class="px-4 py-2 rounded-lg bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500">
            <option value="">All Categories</option>
            @foreach($categories as $key => $label)
            <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <button type="submit" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            <i class="fas fa-search mr-2"></i> Filter
        </button>
        @if(request()->hasAny(['search', 'status', 'category']))
        <a href="{{ route('admin.projects.index') }}" class="px-4 py-2 text-gray-500 hover:text-gray-700 transition-colors">
            <i class="fas fa-times"></i>
        </a>
        @endif
    </form>
</div>

{{-- Projects Table --}}
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
    @if($projects->count() > 0)
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-gray-700/50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Project</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Featured</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Views</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @foreach($projects as $project)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors {{ $project->trashed() ? 'opacity-50' : '' }}">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-lg overflow-hidden bg-gradient-to-br from-primary-500 to-purple-600 flex-shrink-0">
                                @if($project->featured_image_url)
                                <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="fas fa-folder text-white"></i>
                                </div>
                                @endif
                            </div>
                            <div class="min-w-0">
                                <h4 class="font-semibold truncate max-w-xs">{{ $project->title }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">
                                    {{ $project->short_description ?? Str::limit(strip_tags($project->description), 50) }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300">
                            {{ $project->category_label }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        @if($project->trashed())
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400">
                            Deleted
                        </span>
                        @else
                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $project->status_color }}-100 dark:bg-{{ $project->status_color }}-900/30 text-{{ $project->status_color }}-600 dark:text-{{ $project->status_color }}-400">
                            {{ $project->status_label }}
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if(!$project->trashed())
                        <form action="{{ route('admin.projects.toggleFeatured', $project) }}" method="POST">
                            @csrf
                            <button type="submit" class="text-{{ $project->is_featured ? 'yellow-500' : 'gray-400' }} hover:text-yellow-500 transition-colors">
                                <i class="fas fa-star text-lg"></i>
                            </button>
                        </form>
                        @else
                        <i class="fas fa-star text-gray-300"></i>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        {{ number_format($project->views_count) }}
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-500 dark:text-gray-400">
                        {{ $project->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center justify-end gap-2">
                            @if($project->trashed())
                            <form action="{{ route('admin.projects.restore', $project->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="p-2 rounded-lg hover:bg-green-100 dark:hover:bg-green-900/30 text-green-600 transition-colors" title="Restore">
                                    <i class="fas fa-undo"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.projects.forceDelete', $project->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to permanently delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 text-red-600 transition-colors" title="Delete Permanently">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @else
                            <a href="{{ route('projects.show', $project) }}" target="_blank" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 transition-colors" title="View">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="p-2 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 text-blue-600 transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this project?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 rounded-lg hover:bg-red-100 dark:hover:bg-red-900/30 text-red-600 transition-colors" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
        {{ $projects->links() }}
    </div>
    @else
    <div class="p-12 text-center">
        <i class="fas fa-folder-open text-4xl text-gray-300 dark:text-gray-600 mb-4"></i>
        <h3 class="text-lg font-semibold mb-2">No Projects Found</h3>
        <p class="text-gray-500 dark:text-gray-400 mb-6">
            @if(request()->hasAny(['search', 'status', 'category']))
                No projects match your filters.
            @else
                Get started by creating your first project.
            @endif
        </p>
        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors">
            <i class="fas fa-plus mr-2"></i>
            Create Project
        </a>
    </div>
    @endif
</div>
@endsection
