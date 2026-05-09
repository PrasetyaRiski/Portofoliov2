@extends('layouts.admin')

@section('title', 'Edit Skill')
@section('page-title', 'Edit Skill')

@section('content')
{{-- Page Header --}}
<div class="flex items-center justify-between mb-8">
    <div>
        <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-500">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('admin.skills.index') }}" class="hover:text-primary-500">Skills</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 dark:text-gray-100">Edit</span>
        </nav>
        <h2 class="text-2xl font-bold">Edit: {{ $skill->name }}</h2>
    </div>
</div>

<form action="{{ route('admin.skills.update', $skill) }}" method="POST" x-data="skillForm()">
    @csrf
    @method('PUT')
    
    <div class="max-w-2xl">
        <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
            <h3 class="text-lg font-semibold mb-6">Skill Information</h3>
            
            {{-- Name --}}
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium mb-2">
                    Skill Name <span class="text-red-500">*</span>
                </label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $skill->name) }}"
                    x-model="name"
                    required
                    class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 @error('name') ring-2 ring-red-500 @enderror"
                    placeholder="e.g., Laravel, React, Python"
                >
                @error('name')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Category --}}
            <div class="mb-6">
                <label for="category" class="block text-sm font-medium mb-2">
                    Category <span class="text-red-500">*</span>
                </label>
                <select 
                    id="category" 
                    name="category" 
                    required
                    class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 @error('category') ring-2 ring-red-500 @enderror"
                >
                    <option value="">Select a category</option>
                    @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ old('category', $skill->category) === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @error('category')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            {{-- Icon --}}
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Icon (Optional)</label>
                
                {{-- Icon Type --}}
                <div class="flex gap-4 mb-4">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="icon_type" value="fontawesome" x-model="iconType" class="text-primary-500 focus:ring-primary-500">
                        <span class="text-sm">Font Awesome</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="icon_type" value="devicon" x-model="iconType" class="text-primary-500 focus:ring-primary-500">
                        <span class="text-sm">Devicon</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="icon_type" value="url" x-model="iconType" class="text-primary-500 focus:ring-primary-500">
                        <span class="text-sm">Image URL</span>
                    </label>
                </div>
                
                {{-- Font Awesome Input --}}
                <div x-show="iconType === 'fontawesome'">
                    <input 
                        type="text" 
                        x-model="icon"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                        placeholder="e.g., fab fa-laravel, fas fa-database"
                    >
                    <p class="mt-2 text-sm text-gray-500">
                        <a href="https://fontawesome.com/icons" target="_blank" class="text-primary-500 hover:underline">Browse Font Awesome icons</a>
                    </p>
                </div>
                
                {{-- Devicon Input --}}
                <div x-show="iconType === 'devicon'">
                    <input 
                        type="text" 
                        x-model="icon"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                        placeholder="e.g., devicon-laravel-plain, devicon-react-original"
                    >
                    <p class="mt-2 text-sm text-gray-500">
                        <a href="https://devicon.dev/" target="_blank" class="text-primary-500 hover:underline">Browse Devicon icons</a>
                    </p>
                </div>
                
                {{-- URL Input --}}
                <div x-show="iconType === 'url'">
                    <input 
                        type="url" 
                        x-model="icon"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                        placeholder="https://example.com/icon.svg"
                    >
                </div>
                
                <input type="hidden" name="icon" :value="icon">
            </div>
            
            {{-- Preview --}}
            <div class="p-4 bg-gray-50 dark:bg-gray-900 rounded-xl mb-6">
                <p class="text-sm text-gray-500 mb-3">Preview</p>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 text-sm font-medium">
                    <template x-if="icon && (iconType === 'fontawesome' || iconType === 'devicon')">
                        <i :class="icon" class="text-primary-500"></i>
                    </template>
                    <template x-if="icon && iconType === 'url'">
                        <img :src="icon" class="w-4 h-4 object-contain">
                    </template>
                    <span x-text="name || 'Skill Name'"></span>
                </div>
            </div>
            
            {{-- Hidden fields --}}
            <input type="hidden" name="proficiency" value="{{ $skill->proficiency ?? 50 }}">
            <input type="hidden" name="is_active" value="1">
            <input type="hidden" name="order" value="{{ $skill->order ?? 0 }}">
            
            {{-- Actions --}}
            <div class="flex gap-3">
                <button type="submit" class="flex-1 px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors">
                    <i class="fas fa-save mr-2"></i>
                    Update Skill
                </button>
                <a href="{{ route('admin.skills.index') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
                    Cancel
                </a>
            </div>
        </div>
        
        {{-- Danger Zone --}}
        <div class="mt-6 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-900 p-6">
            <h3 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-4">Danger Zone</h3>
            <p class="text-sm text-red-500 dark:text-red-400 mb-4">
                Once deleted, this skill cannot be recovered.
            </p>
            <form action="{{ route('admin.skills.destroy', $skill) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this skill?');">
                @csrf
                @method('DELETE')
                <button 
                    type="submit"
                    class="px-4 py-2 bg-red-500 text-white rounded-xl font-semibold hover:bg-red-600 transition-colors"
                >
                    <i class="fas fa-trash mr-2"></i>
                    Delete Skill
                </button>
            </form>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function skillForm() {
    @php
        $iconValue = old('icon', $skill->icon);
        $iconType = 'fontawesome';
        if ($iconValue) {
            if (str_starts_with($iconValue, 'http')) {
                $iconType = 'url';
            } elseif (str_starts_with($iconValue, 'devicon')) {
                $iconType = 'devicon';
            }
        }
    @endphp
    return {
        name: @json(old('name', $skill->name)),
        iconType: @json($iconType),
        icon: @json($iconValue ?? '')
    }
}
</script>
@endpush
