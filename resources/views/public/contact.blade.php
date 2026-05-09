@extends('layouts.public')

@section('title', 'Contact - ' . config('portfolio.seo.title'))
@section('description', 'Get in touch with me. I\'d love to hear about your project or opportunity.')

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
                Get In Touch
            </span>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-display font-bold mb-4">
                Let's <span class="gradient-text">Connect</span>
            </h1>
            <p class="text-gray-600 dark:text-gray-400 text-lg max-w-2xl mx-auto">
                Have a project in mind, want to collaborate, or just say hello? 
                I'd love to hear from you!
            </p>
        </div>
    </div>
</section>

{{-- Contact Section --}}
<section class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-12">
            {{-- Contact Info --}}
            <div class="space-y-8">
                <div class="glass-card rounded-2xl p-8">
                    <h2 class="text-2xl font-bold mb-6">Contact Information</h2>
                    
                    <div class="space-y-6">
                        {{-- Email --}}
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-purple-600 flex items-center justify-center text-white flex-shrink-0">
                                <i class="fas fa-envelope text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Email</h3>
                                <a href="mailto:{{ config('portfolio.owner.email') }}" class="text-primary-600 dark:text-primary-400 hover:underline">
                                    {{ config('portfolio.owner.email') }}
                                </a>
                            </div>
                        </div>
                        
                        {{-- Location --}}
                        <div class="flex items-start gap-4">
                            <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center text-white flex-shrink-0">
                                <i class="fas fa-map-marker-alt text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold mb-1">Location</h3>
                                <p class="text-gray-600 dark:text-gray-400">Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Social Links --}}
                <div class="glass-card rounded-2xl p-8">
                    <h2 class="text-xl font-bold mb-6">Follow Me</h2>
                    
                    <div class="grid grid-cols-2 gap-4">
                        @if(config('portfolio.social.github'))
                        <a href="{{ config('portfolio.social.github') }}" target="_blank" class="flex items-center gap-3 p-4 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 transition-colors group">
                            <i class="fab fa-github text-2xl group-hover:scale-110 transition-transform"></i>
                            <span class="font-medium">GitHub</span>
                        </a>
                        @endif
                        
                        @if(config('portfolio.social.twitter'))
                        <a href="{{ config('portfolio.social.twitter') }}" target="_blank" class="flex items-center gap-3 p-4 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-sky-100 dark:hover:bg-sky-900/30 transition-colors group">
                            <i class="fab fa-twitter text-2xl text-sky-500 group-hover:scale-110 transition-transform"></i>
                            <span class="font-medium">Twitter</span>
                        </a>
                        @endif
                        
                        @if(config('portfolio.social.instagram'))
                        <a href="{{ config('portfolio.social.instagram') }}" target="_blank" class="flex items-center gap-3 p-4 rounded-xl bg-gray-100 dark:bg-gray-800 hover:bg-pink-100 dark:hover:bg-pink-900/30 transition-colors group">
                            <i class="fab fa-instagram text-2xl text-pink-600 group-hover:scale-110 transition-transform"></i>
                            <span class="font-medium">Instagram</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            
            {{-- Contact Form --}}
            <div class="lg:col-span-2">
                <div class="glass-card rounded-2xl p-8">
                    <h2 class="text-2xl font-bold mb-6">Send Me a Message</h2>
                    
                    {{-- Success Message --}}
                    @if(session('success'))
                    <div class="mb-6 p-4 rounded-xl bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 flex items-center gap-3">
                        <i class="fas fa-check-circle text-xl"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                    @endif
                    
                    {{-- Error Messages --}}
                    @if($errors->any())
                    <div class="mb-6 p-4 rounded-xl bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400">
                        <p class="font-semibold mb-2">Please fix the following errors:</p>
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid sm:grid-cols-2 gap-6">
                            {{-- Name --}}
                            <div>
                                <label for="name" class="block text-sm font-medium mb-2">
                                    Full Name <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    id="name" 
                                    name="name" 
                                    value="{{ old('name') }}"
                                    required
                                    class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-800 border-0 focus:ring-2 focus:ring-primary-500 transition-all @error('name') ring-2 ring-red-500 @enderror"
                                    placeholder="John Doe"
                                >
                            </div>
                            
                            {{-- Email --}}
                            <div>
                                <label for="email" class="block text-sm font-medium mb-2">
                                    Email Address <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="email" 
                                    id="email" 
                                    name="email" 
                                    value="{{ old('email') }}"
                                    required
                                    class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-800 border-0 focus:ring-2 focus:ring-primary-500 transition-all @error('email') ring-2 ring-red-500 @enderror"
                                    placeholder="john@example.com"
                                >
                            </div>
                        </div>
                        
                        <div class="grid sm:grid-cols-2 gap-6">
                            {{-- Phone --}}
                            <div>
                                <label for="phone" class="block text-sm font-medium mb-2">
                                    Phone Number
                                </label>
                                <input 
                                    type="tel" 
                                    id="phone" 
                                    name="phone" 
                                    value="{{ old('phone') }}"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-800 border-0 focus:ring-2 focus:ring-primary-500 transition-all"
                                    placeholder="+62 812 3456 7890"
                                >
                            </div>
                            
                            {{-- Subject --}}
                            <div>
                                <label for="subject" class="block text-sm font-medium mb-2">
                                    Subject
                                </label>
                                <input 
                                    type="text" 
                                    id="subject" 
                                    name="subject" 
                                    value="{{ old('subject') }}"
                                    class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-800 border-0 focus:ring-2 focus:ring-primary-500 transition-all"
                                    placeholder="Project Inquiry"
                                >
                            </div>
                        </div>
                        
                        {{-- Message --}}
                        <div>
                            <label for="message" class="block text-sm font-medium mb-2">
                                Your Message <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="message" 
                                name="message" 
                                rows="6"
                                required
                                class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-800 border-0 focus:ring-2 focus:ring-primary-500 transition-all resize-none @error('message') ring-2 ring-red-500 @enderror"
                                placeholder="Tell me about your project or just say hello..."
                            >{{ old('message') }}</textarea>
                        </div>
                        
                        {{-- Submit Button --}}
                        <div class="flex items-center justify-between">
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                <span class="text-red-500">*</span> Required fields
                            </p>
                            <button 
                                type="submit" 
                                class="inline-flex items-center px-8 py-4 rounded-xl bg-gradient-to-r from-primary-500 to-purple-600 text-white font-semibold shadow-lg hover:shadow-xl hover:shadow-primary-500/30 transition-all hover:scale-105"
                            >
                                <span>Send Message</span>
                                <i class="fas fa-paper-plane ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
@endpush
