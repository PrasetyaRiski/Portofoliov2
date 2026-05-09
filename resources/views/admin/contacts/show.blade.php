@extends('layouts.admin')

@section('title', 'View Message')
@section('page-title', 'Message Details')

@section('content')
{{-- Page Header --}}
<div class="flex items-center justify-between mb-8">
    <div>
        <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-500">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('admin.contacts.index') }}" class="hover:text-primary-500">Messages</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 dark:text-gray-100">View</span>
        </nav>
        <h2 class="text-2xl font-bold">Message from {{ $contact->name }}</h2>
    </div>
    
    <a href="{{ route('admin.contacts.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
        <i class="fas fa-arrow-left mr-2"></i>
        Back to Messages
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-8">
    {{-- Main Content --}}
    <div class="lg:col-span-2 space-y-6">
        {{-- Message Content --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden">
            {{-- Header --}}
            <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-full bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center text-white text-xl font-bold shrink-0">
                        {{ strtoupper(substr($contact->name, 0, 1)) }}
                    </div>
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-1">
                            <h3 class="font-semibold text-xl">{{ $contact->name }}</h3>
                            @if($contact->is_replied)
                            <span class="px-2 py-0.5 text-xs font-semibold bg-green-100 text-green-700 dark:bg-green-900/50 dark:text-green-300 rounded-full">
                                Replied
                            </span>
                            @endif
                        </div>
                        <a href="mailto:{{ $contact->email }}" class="text-primary-500 hover:underline">
                            {{ $contact->email }}
                        </a>
                    </div>
                    <div class="text-right text-sm text-gray-500 dark:text-gray-400">
                        <div>{{ $contact->created_at->format('M d, Y') }}</div>
                        <div>{{ $contact->created_at->format('h:i A') }}</div>
                    </div>
                </div>
                
                @if($contact->subject)
                <div class="mt-4 pt-4 border-t border-gray-100 dark:border-gray-700">
                    <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Subject:</span>
                    <h4 class="text-lg font-medium mt-1">{{ $contact->subject }}</h4>
                </div>
                @endif
            </div>
            
            {{-- Message Body --}}
            <div class="p-6">
                <div class="prose dark:prose-invert max-w-none">
                    {!! nl2br(e($contact->message)) !!}
                </div>
            </div>
        </div>
        
        {{-- Reply Section --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4">Quick Reply</h3>
            
            <form action="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject ?? 'Your message') }}" method="GET" target="_blank">
                <textarea 
                    name="body"
                    rows="5"
                    class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 resize-none mb-4"
                    placeholder="Write your reply here..."
                ></textarea>
                
                <div class="flex items-center gap-4">
                    <a href="mailto:{{ $contact->email }}?subject=Re: {{ urlencode($contact->subject ?? 'Your message') }}" class="px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Open Email Client
                    </a>
                    
                    @if(!$contact->is_replied)
                    <form action="{{ route('admin.contacts.mark-replied', $contact) }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-6 py-3 bg-green-500 text-white rounded-xl font-semibold hover:bg-green-600 transition-colors">
                            <i class="fas fa-check mr-2"></i>
                            Mark as Replied
                        </button>
                    </form>
                    @endif
                </div>
            </form>
        </div>
    </div>
    
    {{-- Sidebar --}}
    <div class="space-y-6">
        {{-- Contact Info --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4">Contact Information</h3>
            
            <div class="space-y-4">
                <div>
                    <label class="text-sm text-gray-500 dark:text-gray-400">Full Name</label>
                    <p class="font-medium mt-1">{{ $contact->name }}</p>
                </div>
                
                <div>
                    <label class="text-sm text-gray-500 dark:text-gray-400">Email Address</label>
                    <p class="font-medium mt-1">
                        <a href="mailto:{{ $contact->email }}" class="text-primary-500 hover:underline">
                            {{ $contact->email }}
                        </a>
                    </p>
                </div>
                
                @if($contact->phone)
                <div>
                    <label class="text-sm text-gray-500 dark:text-gray-400">Phone Number</label>
                    <p class="font-medium mt-1">
                        <a href="tel:{{ $contact->phone }}" class="text-primary-500 hover:underline">
                            {{ $contact->phone }}
                        </a>
                    </p>
                </div>
                @endif
            </div>
        </div>
        
        {{-- Message Stats --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4">Message Details</h3>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Status</span>
                    <span class="font-semibold {{ $contact->is_read ? 'text-gray-500' : 'text-primary-500' }}">
                        {{ $contact->is_read ? 'Read' : 'Unread' }}
                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Received</span>
                    <span class="font-semibold">{{ $contact->created_at->diffForHumans() }}</span>
                </div>
                @if($contact->read_at)
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Read at</span>
                    <span class="font-semibold">{{ $contact->read_at->diffForHumans() }}</span>
                </div>
                @endif
                @if($contact->replied_at)
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 dark:text-gray-400">Replied at</span>
                    <span class="font-semibold">{{ $contact->replied_at->diffForHumans() }}</span>
                </div>
                @endif
                @if($contact->ip_address)
                <div class="flex items-center justify-between">
                    <span class="text-gray-500 dark:text-gray-400">IP Address</span>
                    <span class="font-mono text-sm">{{ $contact->ip_address }}</span>
                </div>
                @endif
            </div>
        </div>
        
        {{-- Quick Actions --}}
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-4">Quick Actions</h3>
            
            <div class="space-y-3">
                <a href="mailto:{{ $contact->email }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center">
                        <i class="fas fa-envelope text-primary-500"></i>
                    </div>
                    <span class="font-medium">Send Email</span>
                </a>
                
                @if($contact->phone)
                <a href="tel:{{ $contact->phone }}" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <i class="fas fa-phone text-green-500"></i>
                    </div>
                    <span class="font-medium">Call</span>
                </a>
                
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" target="_blank" class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <div class="w-10 h-10 rounded-lg bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                        <i class="fab fa-whatsapp text-green-500"></i>
                    </div>
                    <span class="font-medium">WhatsApp</span>
                </a>
                @endif
            </div>
        </div>
        
        {{-- Danger Zone --}}
        <div class="bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-900 p-6">
            <h3 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-4">Danger Zone</h3>
            <p class="text-sm text-red-500 dark:text-red-400 mb-4">
                Once deleted, this message cannot be recovered.
            </p>
            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this message?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-4 py-2 bg-red-500 text-white rounded-xl font-semibold hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash mr-2"></i>
                    Delete Message
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
