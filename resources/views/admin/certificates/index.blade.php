@extends('layouts.admin')

@section('title', 'Certificates')
@section('page-title', 'Manage Certificates')

@section('content')
{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold mb-1">Certificates</h2>
        <p class="text-gray-500 dark:text-gray-400">Manage your certifications and achievements</p>
    </div>
    <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center justify-center px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors">
        <i class="fas fa-plus mr-2"></i>
        Add Certificate
    </a>
</div>

{{-- Filters --}}
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-6">
    <form action="{{ route('admin.certificates.index') }}" method="GET" class="flex flex-wrap gap-4">
        {{-- Search --}}
        <div class="flex-1 min-w-[200px]">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search certificates..."
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
        
        {{-- Status Filter --}}
        <select name="status" class="px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500">
            <option value="">All Status</option>
            <option value="published" {{ request('status') === 'published' ? 'selected' : '' }}>Published</option>
            <option value="draft" {{ request('status') === 'draft' ? 'selected' : '' }}>Draft</option>
        </select>
        
        {{-- Submit --}}
        <button type="submit" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 rounded-xl font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            <i class="fas fa-filter mr-2"></i>
            Filter
        </button>
        
        @if(request()->hasAny(['search', 'category', 'status']))
        <a href="{{ route('admin.certificates.index') }}" class="px-6 py-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
            <i class="fas fa-times mr-1"></i>
            Clear
        </a>
        @endif
    </form>
</div>

{{-- Certificates Grid --}}
@if($certificates->count() > 0)
<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    @foreach($certificates as $certificate)
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden group">
        {{-- Image --}}
        <div class="aspect-[4/3] relative overflow-hidden bg-gradient-to-br from-primary-500/20 to-secondary-500/20">
            @if($certificate->image)
            <img src="{{ $certificate->image_url }}" alt="{{ $certificate->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            @else
            <div class="w-full h-full flex items-center justify-center">
                <i class="fas fa-certificate text-6xl text-primary-500/30"></i>
            </div>
            @endif
            
            {{-- Status Badge --}}
            <div class="absolute top-3 left-3">
                <span class="px-3 py-1 text-xs font-semibold rounded-full {{ $certificate->status === 'published' ? 'bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300' : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/50 dark:text-yellow-300' }}">
                    {{ ucfirst($certificate->status) }}
                </span>
            </div>
            
            {{-- Featured Badge --}}
            @if($certificate->is_featured)
            <div class="absolute top-3 right-3">
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-primary-100 text-primary-700 dark:bg-primary-900/50 dark:text-primary-300">
                    <i class="fas fa-star mr-1"></i> Featured
                </span>
            </div>
            @endif
        </div>
        
        {{-- Content --}}
        <div class="p-5">
            <div class="flex items-start justify-between gap-4 mb-3">
                <div>
                    <h3 class="font-bold text-lg line-clamp-1">{{ $certificate->title }}</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $certificate->issuer }}</p>
                </div>
                <span class="px-2 py-1 text-xs font-medium rounded-lg bg-gray-100 dark:bg-gray-700 whitespace-nowrap">
                    {{ $certificate->category_label }}
                </span>
            </div>
            
            <div class="flex items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-4">
                @if($certificate->issue_date)
                <span>
                    <i class="fas fa-calendar mr-1"></i>
                    {{ $certificate->issue_date->format('M Y') }}
                </span>
                @endif
                
                @if($certificate->credential_id)
                <span class="truncate">
                    <i class="fas fa-id-card mr-1"></i>
                    {{ $certificate->credential_id }}
                </span>
                @endif
            </div>
            
            {{-- Actions --}}
            <div class="flex items-center justify-between pt-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-2">
                    @if($certificate->credential_url)
                    <a href="{{ $certificate->credential_url }}" target="_blank" class="px-3 py-1.5 text-sm font-medium text-primary-500 hover:bg-primary-50 dark:hover:bg-primary-900/30 rounded-lg transition-colors">
                        <i class="fas fa-external-link-alt mr-1"></i>
                        View
                    </a>
                    @endif
                </div>
                
                <div class="flex items-center gap-1">
                    <a href="{{ route('admin.certificates.edit', $certificate) }}" class="p-2 text-gray-500 hover:text-primary-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this certificate?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-gray-500 hover:text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Pagination --}}
<div class="mt-6">
    {{ $certificates->withQueryString()->links() }}
</div>
@else
{{-- Empty State --}}
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-12 text-center">
    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
        <i class="fas fa-certificate text-2xl text-gray-400"></i>
    </div>
    <h3 class="text-lg font-semibold mb-2">No certificates found</h3>
    <p class="text-gray-500 dark:text-gray-400 mb-6">
        @if(request()->hasAny(['search', 'category', 'status']))
            No certificates match your filters. Try adjusting your search.
        @else
            Start by adding your first certificate.
        @endif
    </p>
    <a href="{{ route('admin.certificates.create') }}" class="inline-flex items-center px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors">
        <i class="fas fa-plus mr-2"></i>
        Add Certificate
    </a>
</div>
@endif
@endsection
