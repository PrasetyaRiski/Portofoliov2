@extends('layouts.admin')

@section('title', 'Skills')
@section('page-title', 'Manage Skills')

@section('content')
{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold mb-1">Skills</h2>
        <p class="text-gray-500 dark:text-gray-400">Manage your technical and soft skills</p>
    </div>
    <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors">
        <i class="fas fa-plus mr-2"></i>
        Add Skill
    </a>
</div>

{{-- Stats --}}
<div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
    @foreach($categories as $key => $label)
    @php
        $count = $skills->where('category', $key)->count();
        $colors = [
            'programming' => 'indigo',
            'framework' => 'purple',
            'database' => 'blue',
            'devops' => 'green',
            'design' => 'pink',
            'soft_skill' => 'yellow',
            'other' => 'gray'
        ];
        $color = $colors[$key] ?? 'gray';
    @endphp
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-lg bg-{{ $color }}-100 dark:bg-{{ $color }}-900/30 flex items-center justify-center">
                <span class="text-{{ $color }}-500 font-bold">{{ $count }}</span>
            </div>
            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $label }}</span>
        </div>
    </div>
    @endforeach
</div>

{{-- Filters --}}
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-6">
    <form action="{{ route('admin.skills.index') }}" method="GET" class="flex flex-wrap gap-4">
        {{-- Search --}}
        <div class="flex-1 min-w-[200px]">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search skills..."
                    class="w-full pl-10 pr-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                >
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
        
        {{-- Category Filter --}}
        <select name="category" class="px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500">
            <option value="">All Categories</option>
            @foreach($categories as $key => $label)
            <option value="{{ $key }}" {{ request('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        
        {{-- Submit --}}
        <button type="submit" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 rounded-xl font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            <i class="fas fa-filter mr-2"></i>
            Filter
        </button>
        
        @if(request()->hasAny(['search', 'category']))
        <a href="{{ route('admin.skills.index') }}" class="px-6 py-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
            <i class="fas fa-times mr-1"></i>
            Clear
        </a>
        @endif
    </form>
</div>

@if($skills->count() > 0)
{{-- Skills by Category --}}
@foreach($categories as $categoryKey => $categoryLabel)
@php
    $categorySkills = $skills->where('category', $categoryKey);
@endphp
@if($categorySkills->count() > 0)
<div class="mb-8">
    <h3 class="text-lg font-semibold mb-4">{{ $categoryLabel }}</h3>
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
        @foreach($categorySkills as $skill)
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 group hover:border-primary-500/50 transition-colors">
            <div class="flex items-start gap-4">
                {{-- Icon --}}
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500/10 to-secondary-500/10 flex items-center justify-center shrink-0 overflow-hidden">
                    @if($skill->icon)
                        @if(str_starts_with($skill->icon, 'fa'))
                        <i class="{{ $skill->icon }} text-xl text-primary-500"></i>
                        @else
                        <img src="{{ $skill->icon }}" alt="{{ $skill->name }}" class="w-8 h-8 object-contain">
                        @endif
                    @else
                    <i class="fas fa-code text-xl text-primary-500"></i>
                    @endif
                </div>
                
                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        <h4 class="font-semibold truncate">{{ $skill->name }}</h4>
                        @if(!$skill->is_active)
                        <span class="px-2 py-0.5 text-xs bg-gray-100 dark:bg-gray-700 text-gray-500 rounded-full">Hidden</span>
                        @endif
                    </div>
                    
                    {{-- Progress Bar --}}
                    <div class="flex items-center gap-3">
                        <div class="flex-1 h-2 bg-gray-200 dark:bg-gray-700 rounded-full overflow-hidden">
                            <div 
                                class="h-full bg-gradient-to-r from-primary-500 to-secondary-500 rounded-full transition-all"
                                style="width: {{ $skill->proficiency }}%"
                            ></div>
                        </div>
                        <span class="text-sm font-medium text-gray-500">{{ $skill->proficiency }}%</span>
                    </div>
                </div>
            </div>
            
            {{-- Actions --}}
            <div class="flex items-center justify-end gap-2 mt-4 pt-4 border-t border-gray-100 dark:border-gray-700 opacity-0 group-hover:opacity-100 transition-opacity">
                <a href="{{ route('admin.skills.edit', $skill) }}" class="px-3 py-1.5 text-sm font-medium text-primary-500 hover:bg-primary-50 dark:hover:bg-primary-900/30 rounded-lg transition-colors">
                    <i class="fas fa-edit mr-1"></i>
                    Edit
                </a>
                <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-1.5 text-sm font-medium text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors">
                        <i class="fas fa-trash mr-1"></i>
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endforeach

{{-- Pagination --}}
@if($skills instanceof \Illuminate\Pagination\LengthAwarePaginator)
<div class="mt-6">
    {{ $skills->withQueryString()->links() }}
</div>
@endif

@else
{{-- Empty State --}}
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-12 text-center">
    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
        <i class="fas fa-laptop-code text-2xl text-gray-400"></i>
    </div>
    <h3 class="text-lg font-semibold mb-2">No skills found</h3>
    <p class="text-gray-500 dark:text-gray-400 mb-6">
        @if(request()->hasAny(['search', 'category']))
            No skills match your filters. Try adjusting your search.
        @else
            Start by adding your skills.
        @endif
    </p>
    <a href="{{ route('admin.skills.create') }}" class="inline-flex items-center px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors">
        <i class="fas fa-plus mr-2"></i>
        Add Skill
    </a>
</div>
@endif
@endsection
