@extends('layouts.public')

@section('title', 'Login - Admin')

@section('content')
<div class="min-h-screen flex items-center justify-center py-20 px-4" x-data="{ showPassword: false }">
    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-primary-500 to-secondary-500 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <span class="text-white font-bold text-xl">{{ substr(config('portfolio.owner.name', 'P'), 0, 1) }}</span>
                </div>
                <span class="text-2xl font-bold">
                    {{ config('portfolio.owner.name', 'Portfolio') }}
                </span>
            </a>
        </div>
        
        {{-- Login Card --}}
        <div class="bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-gray-200 dark:border-gray-700 shadow-2xl p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold mb-2">Welcome Back</h1>
                <p class="text-gray-500 dark:text-gray-400">Sign in to access your admin panel</p>
            </div>
            
            {{-- Error Messages --}}
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-100 dark:bg-red-900/50 border border-red-200 dark:border-red-800 rounded-xl">
                <div class="flex items-center gap-3">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                    <span class="text-red-600 dark:text-red-400 text-sm">{{ $errors->first() }}</span>
                </div>
            </div>
            @endif
            
            {{-- Session Status --}}
            @if(session('status'))
            <div class="mb-6 p-4 bg-green-100 dark:bg-green-900/50 border border-green-200 dark:border-green-800 rounded-xl">
                <div class="flex items-center gap-3">
                    <i class="fas fa-check-circle text-green-500"></i>
                    <span class="text-green-600 dark:text-green-400 text-sm">{{ session('status') }}</span>
                </div>
            </div>
            @endif
            
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                {{-- Email --}}
                <div class="mb-6">
                    <label for="email" class="block text-sm font-medium mb-2">Email Address</label>
                    <div class="relative">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required 
                            autofocus
                            autocomplete="email"
                            class="w-full pl-12 pr-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 @error('email') ring-2 ring-red-500 @enderror"
                            placeholder="admin@example.com"
                        >
                        <i class="fas fa-envelope absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
                
                {{-- Password --}}
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium mb-2">Password</label>
                    <div class="relative">
                        <input 
                            :type="showPassword ? 'text' : 'password'"
                            id="password" 
                            name="password" 
                            required
                            autocomplete="current-password"
                            class="w-full pl-12 pr-12 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 @error('password') ring-2 ring-red-500 @enderror"
                            placeholder="••••••••"
                        >
                        <i class="fas fa-lock absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <button 
                            type="button"
                            @click="showPassword = !showPassword"
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors"
                        >
                            <i class="fas" :class="showPassword ? 'fa-eye-slash' : 'fa-eye'"></i>
                        </button>
                    </div>
                </div>
                
                {{-- Remember Me --}}
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="remember"
                            class="w-4 h-4 rounded border-gray-300 text-primary-500 focus:ring-primary-500"
                        >
                        <span class="text-sm">Remember me</span>
                    </label>
                    
                    @if(Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-primary-500 hover:underline">
                        Forgot password?
                    </a>
                    @endif
                </div>
                
                {{-- Submit --}}
                <button type="submit" class="w-full py-3 px-6 bg-gradient-to-r from-primary-500 to-secondary-500 text-white rounded-xl font-semibold hover:opacity-90 transition-opacity focus:ring-4 focus:ring-primary-500/50">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Sign In
                </button>
            </form>
        </div>
        
        {{-- Back to Home --}}
        <div class="text-center mt-8">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-gray-500 dark:text-gray-400 hover:text-primary-500 transition-colors">
                <i class="fas fa-arrow-left"></i>
                Back to Website
            </a>
        </div>
    </div>
</div>
@endsection
