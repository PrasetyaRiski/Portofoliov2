@extends('layouts.admin')

@section('title', 'Messages')
@section('page-title', 'Contact Messages')

@section('content')
{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
    <div>
        <h2 class="text-2xl font-bold mb-1">Contact Messages</h2>
        <p class="text-gray-500 dark:text-gray-400">
            Manage messages from your contact form
            @if($unreadCount > 0)
            <span class="ml-2 px-2 py-0.5 bg-red-100 text-red-600 dark:bg-red-900/50 dark:text-red-400 rounded-full text-sm">
                {{ $unreadCount }} unread
            </span>
            @endif
        </p>
    </div>
    
    @if($contacts->count() > 0)
    <div class="flex items-center gap-3">
        <form action="{{ route('admin.contacts.mark-all-read') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                <i class="fas fa-check-double mr-2"></i>
                Mark All Read
            </button>
        </form>
    </div>
    @endif
</div>

{{-- Filters --}}
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-4 mb-6">
    <form action="{{ route('admin.contacts.index') }}" method="GET" class="flex flex-wrap gap-4">
        {{-- Search --}}
        <div class="flex-1 min-w-[200px]">
            <div class="relative">
                <input 
                    type="text" 
                    name="search" 
                    value="{{ request('search') }}"
                    placeholder="Search by name, email, or message..."
                    class="w-full pl-10 pr-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                >
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
            </div>
        </div>
        
        {{-- Status Filter --}}
        <select name="status" class="px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500">
            <option value="">All Messages</option>
            <option value="unread" {{ request('status') === 'unread' ? 'selected' : '' }}>Unread</option>
            <option value="read" {{ request('status') === 'read' ? 'selected' : '' }}>Read</option>
            <option value="replied" {{ request('status') === 'replied' ? 'selected' : '' }}>Replied</option>
        </select>
        
        {{-- Submit --}}
        <button type="submit" class="px-6 py-2 bg-gray-200 dark:bg-gray-700 rounded-xl font-medium hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            <i class="fas fa-filter mr-2"></i>
            Filter
        </button>
        
        @if(request()->hasAny(['search', 'status']))
        <a href="{{ route('admin.contacts.index') }}" class="px-6 py-2 text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
            <i class="fas fa-times mr-1"></i>
            Clear
        </a>
        @endif
    </form>
</div>

@if($contacts->count() > 0)
{{-- Messages List --}}
<div class="space-y-4">
    @foreach($contacts as $contact)
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden {{ !$contact->is_read ? 'border-l-4 border-l-primary-500' : '' }}">
        <div class="p-6">
            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-4">
                {{-- Sender Info --}}
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center text-white font-bold shrink-0">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div>
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="font-semibold text-lg">{{ $contact->name }}</h3>
                            @if(!$contact->is_read)
                            <span class="px-2 py-0.5 text-xs font-semibold bg-primary-100 text-primary-700 dark:bg-primary-900/50 dark:text-primary-300 rounded-full">
                                New
                            </span>
                            @endif
                            @if($contact->is_replied)
                            <span class="px-2 py-0.5 text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300 rounded-full">
                                Replied
                            </span>
                            @endif
                        </div>
                        <a href="mailto:{{ $contact->email }}" class="text-primary-500 hover:underline text-sm">
                            {{ $contact->email }}
                        </a>
                        @if($contact->phone)
                        <span class="text-gray-400 mx-2">•</span>
                        <a href="tel:{{ $contact->phone }}" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 text-sm">
                            {{ $contact->phone }}
                        </a>
                        @endif
                    </div>
                </div>
                
                {{-- Date & Actions --}}
                <div class="flex items-center gap-4 sm:text-right">
                    <span class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $contact->created_at->diffForHumans() }}
                    </span>
                </div>
            </div>
            
            {{-- Subject --}}
            @if($contact->subject)
            <div class="mt-4 mb-2">
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Subject:</span>
                <span class="font-medium">{{ $contact->subject }}</span>
            </div>
            @endif
            
            {{-- Message Preview --}}
            <div class="mt-4 text-gray-600 dark:text-gray-300 line-clamp-2">
                {{ $contact->message }}
            </div>
            
            {{-- Actions --}}
            <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                <div class="flex items-center gap-2">
                    <a href="{{ route('admin.contacts.show', $contact) }}" class="px-4 py-2 text-sm font-medium text-primary-500 hover:bg-primary-50 dark:hover:bg-primary-900/30 rounded-lg transition-colors">
                        <i class="fas fa-eye mr-1"></i>
                        View
                    </a>
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" class="px-4 py-2 text-sm font-medium text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors">
                        <i class="fas fa-reply mr-1"></i>
                        Reply
                    </a>
                </div>
                
                <div class="flex items-center gap-2">
                    @if(!$contact->is_read)
                    <form action="{{ route('admin.contacts.mark-read', $contact) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="p-2 text-gray-500 hover:text-green-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors" title="Mark as read">
                            <i class="fas fa-check"></i>
                        </button>
                    </form>
                    @endif
                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="p-2 text-gray-500 hover:text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg transition-colors" title="Delete">
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
    {{ $contacts->withQueryString()->links() }}
</div>

@else
{{-- Empty State --}}
<div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-12 text-center">
    <div class="w-16 h-16 mx-auto mb-4 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center">
        <i class="fas fa-inbox text-2xl text-gray-400"></i>
    </div>
    <h3 class="text-lg font-semibold mb-2">No messages found</h3>
    <p class="text-gray-500 dark:text-gray-400">
        @if(request()->hasAny(['search', 'status']))
            No messages match your filters. Try adjusting your search.
        @else
            When visitors send messages through your contact form, they'll appear here.
        @endif
    </p>
</div>
@endif
@endsection
