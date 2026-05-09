@extends('layouts.admin')

@section('title', 'Add Certificate')
@section('page-title', 'Add New Certificate')

@section('content')
{{-- Page Header --}}
<div class="flex items-center justify-between mb-8">
    <div>
        <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-500">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('admin.certificates.index') }}" class="hover:text-primary-500">Certificates</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 dark:text-gray-100">Create</span>
        </nav>
        <h2 class="text-2xl font-bold">Add New Certificate</h2>
    </div>
</div>

<form action="{{ route('admin.certificates.store') }}" method="POST" enctype="multipart/form-data" x-data="certificateForm()">
    @csrf
    <input type="hidden" name="is_verified" value="1">
    
    <div class="grid lg:grid-cols-3 gap-8">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Basic Information --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-6">Certificate Information</h3>
                
                {{-- Title --}}
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium mb-2">
                        Certificate Title <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title') }}"
                        required
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 @error('title') ring-2 ring-red-500 @enderror"
                        placeholder="e.g., AWS Solutions Architect Associate"
                    >
                    @error('title')
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
                        <option value="{{ $key }}" {{ old('category') === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Issuer --}}
                <div class="mb-6">
                    <label for="issuer" class="block text-sm font-medium mb-2">
                        Issuing Organization <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="issuer" 
                        name="issuer" 
                        value="{{ old('issuer') }}"
                        required
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 @error('issuer') ring-2 ring-red-500 @enderror"
                        placeholder="e.g., Amazon Web Services, Google, Coursera"
                    >
                    @error('issuer')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium mb-2">
                        Description
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="4"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 resize-none"
                        placeholder="Brief description of what this certificate represents"
                    >{{ old('description') }}</textarea>
                </div>
            </div>
            
            {{-- Certificate Image --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-6">Certificate Image</h3>
                
                <div 
                    class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-primary-500 transition-colors cursor-pointer"
                    x-on:click="$refs.imageInput.click()"
                    x-on:dragover.prevent="$event.target.classList.add('border-primary-500')"
                    x-on:dragleave.prevent="$event.target.classList.remove('border-primary-500')"
                    x-on:drop.prevent="handleImageDrop($event)"
                >
                    <template x-if="imagePreview">
                        <img :src="imagePreview" class="max-h-64 mx-auto rounded-lg mb-4">
                    </template>
                    <template x-if="!imagePreview">
                        <div>
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                            <p class="text-gray-600 dark:text-gray-400 mb-2">Drag and drop or click to upload</p>
                            <p class="text-sm text-gray-400">PNG, JPG, GIF, WebP or PDF up to 5MB</p>
                        </div>
                    </template>
                </div>
                <input 
                    type="file" 
                    name="certificate_image" 
                    x-ref="imageInput"
                    @change="handleImageChange($event)"
                    accept="image/*,.pdf"
                    class="hidden"
                >
                @error('certificate_image')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Publish Settings --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-6">Publish Settings</h3>
                
                {{-- Status --}}
                <div class="mb-6">
                    <label for="status" class="block text-sm font-medium mb-2">Status</label>
                    <select 
                        id="status" 
                        name="status" 
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                    >
                        <option value="draft" {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                
                {{-- Featured --}}
                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="is_featured" 
                            value="1"
                            {{ old('is_featured') ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 text-primary-500 focus:ring-primary-500"
                        >
                        <span class="font-medium">Feature this certificate</span>
                    </label>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 ml-8">
                        Featured certificates appear prominently
                    </p>
                </div>
                
                {{-- Order --}}
                <div>
                    <label for="order" class="block text-sm font-medium mb-2">Display Order</label>
                    <input 
                        type="number" 
                        id="order" 
                        name="order" 
                        value="{{ old('order', 0) }}"
                        min="0"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                    >
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Lower numbers appear first
                    </p>
                </div>
            </div>
            
            {{-- Actions --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <button type="submit" class="w-full px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors mb-3">
                    <i class="fas fa-save mr-2"></i>
                    Save Certificate
                </button>
                <a href="{{ route('admin.certificates.index') }}" class="block w-full px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-center">
                    Cancel
                </a>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
function certificateForm() {
    return {
        imagePreview: null,
        
        handleImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                if (file.type === 'application/pdf') {
                    this.imagePreview = null;
                } else {
                    this.imagePreview = URL.createObjectURL(file);
                }
            }
        },
        
        handleImageDrop(event) {
            event.target.classList.remove('border-primary-500');
            const file = event.dataTransfer.files[0];
            if (file) {
                this.$refs.imageInput.files = event.dataTransfer.files;
                if (file.type !== 'application/pdf') {
                    this.imagePreview = URL.createObjectURL(file);
                }
            }
        }
    }
}
</script>
@endpush
