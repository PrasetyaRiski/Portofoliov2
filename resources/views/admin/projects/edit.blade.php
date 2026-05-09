@extends('layouts.admin')

@section('title', 'Edit Project')
@section('page-title', 'Edit Project')

@section('content')
{{-- Page Header --}}
<div class="flex items-center justify-between mb-8">
    <div>
        <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-500">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('admin.projects.index') }}" class="hover:text-primary-500">Projects</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 dark:text-gray-100">Edit</span>
        </nav>
        <h2 class="text-2xl font-bold">Edit: {{ $project->title }}</h2>
    </div>
    
    <div class="flex items-center gap-3">
        <a href="{{ route('projects.show', $project->slug) }}" target="_blank" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors">
            <i class="fas fa-external-link-alt mr-2"></i>
            View Live
        </a>
    </div>
</div>

<form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data" x-data="projectForm()">
    @csrf
    @method('PUT')
    
    <div class="grid lg:grid-cols-3 gap-8">
        {{-- Main Content --}}
        <div class="lg:col-span-2 space-y-6">
            {{-- Basic Information --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-6">Basic Information</h3>
                
                {{-- Title --}}
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium mb-2">
                        Project Title <span class="text-red-500">*</span>
                    </label>
                    <input 
                        type="text" 
                        id="title" 
                        name="title" 
                        value="{{ old('title', $project->title) }}"
                        required
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 @error('title') ring-2 ring-red-500 @enderror"
                        placeholder="Enter project title"
                    >
                    @error('title')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Slug --}}
                <div class="mb-6">
                    <label for="slug" class="block text-sm font-medium mb-2">
                        Slug
                    </label>
                    <div class="flex items-center">
                        <span class="px-4 py-3 bg-gray-200 dark:bg-gray-600 rounded-l-xl text-gray-500 dark:text-gray-400 text-sm">
                            {{ url('/projects') }}/
                        </span>
                        <input 
                            type="text" 
                            id="slug" 
                            name="slug" 
                            value="{{ old('slug', $project->slug) }}"
                            class="flex-1 px-4 py-3 bg-gray-100 dark:bg-gray-700 rounded-r-xl border-0 focus:ring-2 focus:ring-primary-500"
                            placeholder="project-slug"
                        >
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Leave empty to auto-generate from title
                    </p>
                    @error('slug')
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
                        <option value="{{ $key }}" {{ old('category', $project->category) === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('category')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Short Description --}}
                <div class="mb-6">
                    <label for="short_description" class="block text-sm font-medium mb-2">
                        Short Description
                    </label>
                    <textarea 
                        id="short_description" 
                        name="short_description" 
                        rows="2"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 resize-none"
                        placeholder="Brief description for cards (max 500 characters)"
                        maxlength="500"
                    >{{ old('short_description', $project->short_description) }}</textarea>
                </div>
                
                {{-- Description --}}
                <div>
                    <label for="description" class="block text-sm font-medium mb-2">
                        Full Description <span class="text-red-500">*</span>
                    </label>
                    <textarea 
                        id="description" 
                        name="description" 
                        rows="8"
                        required
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500 resize-none @error('description') ring-2 ring-red-500 @enderror"
                        placeholder="Detailed description of your project"
                    >{{ old('description', $project->description) }}</textarea>
                    @error('description')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            {{-- Technologies --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-6">Technologies Used</h3>
                
                <div>
                    <label for="technologies" class="block text-sm font-medium mb-2">
                        Technologies (comma separated)
                    </label>
                    <input 
                        type="text" 
                        id="technologies" 
                        name="technologies" 
                        value="{{ old('technologies', is_array($project->technologies) ? implode(', ', $project->technologies) : $project->technologies) }}"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                        placeholder="Laravel, Vue.js, MySQL, Tailwind CSS"
                    >
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Enter technologies separated by commas
                    </p>
                </div>
            </div>
            
            {{-- Media --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-6">Media</h3>
                
                {{-- Current Featured Image --}}
                @if($project->featured_image)
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Current Featured Image</label>
                    <div class="relative inline-block">
                        <img src="{{ $project->featured_image_url }}" alt="{{ $project->title }}" class="max-h-48 rounded-lg">
                        <label class="absolute top-2 right-2 px-3 py-1 bg-red-500/90 text-white text-sm rounded-lg cursor-pointer hover:bg-red-600 transition-colors">
                            <input type="checkbox" name="remove_featured_image" value="1" class="hidden">
                            <i class="fas fa-trash mr-1"></i> Remove
                        </label>
                    </div>
                </div>
                @endif
                
                {{-- Featured Image Upload --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">
                        {{ $project->featured_image ? 'Replace Featured Image' : 'Featured Image' }}
                    </label>
                    <div 
                        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-primary-500 transition-colors cursor-pointer"
                        x-on:click="$refs.featuredImage.click()"
                        x-on:dragover.prevent="$event.target.classList.add('border-primary-500')"
                        x-on:dragleave.prevent="$event.target.classList.remove('border-primary-500')"
                        x-on:drop.prevent="handleFeaturedImageDrop($event)"
                    >
                        <template x-if="featuredImagePreview">
                            <img :src="featuredImagePreview" class="max-h-48 mx-auto rounded-lg mb-4">
                        </template>
                        <template x-if="!featuredImagePreview">
                            <div>
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <p class="text-gray-600 dark:text-gray-400 mb-2">Drag and drop or click to upload</p>
                                <p class="text-sm text-gray-400">PNG, JPG, GIF, WebP up to 5MB</p>
                            </div>
                        </template>
                    </div>
                    <input 
                        type="file" 
                        name="featured_image" 
                        x-ref="featuredImage"
                        @change="handleFeaturedImageChange($event)"
                        accept="image/*"
                        class="hidden"
                    >
                    @error('featured_image')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Current Gallery Images --}}
                @if($project->gallery_images && count($project->gallery_images) > 0)
                <div class="mb-6">
                    <label class="block text-sm font-medium mb-2">Current Gallery Images</label>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($project->gallery_images as $index => $image)
                        <div class="relative aspect-video rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700">
                            <img src="{{ Storage::url($image) }}" class="w-full h-full object-cover">
                            <label class="absolute top-2 right-2 w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition-colors cursor-pointer">
                                <input type="checkbox" name="remove_gallery_images[]" value="{{ $index }}" class="hidden">
                                <i class="fas fa-times text-xs"></i>
                            </label>
                        </div>
                        @endforeach
                    </div>
                    <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                        Click the X button to mark images for removal
                    </p>
                </div>
                @endif
                
                {{-- Gallery Images Upload --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Add Gallery Images</label>
                    <div 
                        class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-8 text-center hover:border-primary-500 transition-colors cursor-pointer"
                        x-on:click="$refs.galleryImages.click()"
                    >
                        <i class="fas fa-images text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600 dark:text-gray-400 mb-2">Upload multiple images</p>
                        <p class="text-sm text-gray-400">You can select multiple files</p>
                    </div>
                    <input 
                        type="file" 
                        name="gallery_images[]" 
                        x-ref="galleryImages"
                        @change="handleGalleryChange($event)"
                        accept="image/*"
                        multiple
                        class="hidden"
                    >
                    
                    {{-- New Gallery Preview --}}
                    <div x-show="galleryPreviews.length > 0" class="mt-4">
                        <label class="block text-sm font-medium mb-2 text-green-500">New Images to Add</label>
                        <div class="grid grid-cols-4 gap-4">
                            <template x-for="(preview, index) in galleryPreviews" :key="index">
                                <div class="relative aspect-video rounded-lg overflow-hidden bg-gray-100 dark:bg-gray-700 ring-2 ring-green-500">
                                    <img :src="preview" class="w-full h-full object-cover">
                                    <button 
                                        type="button"
                                        @click="removeGalleryImage(index)"
                                        class="absolute top-2 right-2 w-6 h-6 rounded-full bg-red-500 text-white flex items-center justify-center hover:bg-red-600 transition-colors"
                                    >
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                    
                    @error('gallery_images')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            {{-- Links --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-6">Links</h3>
                
                <div class="grid sm:grid-cols-2 gap-6">
                    {{-- Demo URL --}}
                    <div>
                        <label for="demo_url" class="block text-sm font-medium mb-2">
                            <i class="fas fa-external-link-alt mr-2 text-gray-400"></i>Demo URL
                        </label>
                        <input 
                            type="url" 
                            id="demo_url" 
                            name="demo_url" 
                            value="{{ old('demo_url', $project->demo_url) }}"
                            class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                            placeholder="https://demo.example.com"
                        >
                        @error('demo_url')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- GitHub URL --}}
                    <div>
                        <label for="github_url" class="block text-sm font-medium mb-2">
                            <i class="fab fa-github mr-2 text-gray-400"></i>GitHub URL
                        </label>
                        <input 
                            type="url" 
                            id="github_url" 
                            name="github_url" 
                            value="{{ old('github_url', $project->github_url) }}"
                            class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                            placeholder="https://github.com/username/repo"
                        >
                        @error('github_url')
                        <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
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
                        @foreach($statuses as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $project->status) === $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Featured --}}
                <div class="mb-6">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input 
                            type="checkbox" 
                            name="is_featured" 
                            value="1"
                            {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                            class="w-5 h-5 rounded border-gray-300 text-primary-500 focus:ring-primary-500"
                        >
                        <span class="font-medium">Feature this project</span>
                    </label>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 ml-8">
                        Featured projects appear on the homepage
                    </p>
                </div>
                
                {{-- Order --}}
                <div>
                    <label for="order" class="block text-sm font-medium mb-2">Display Order</label>
                    <input 
                        type="number" 
                        id="order" 
                        name="order" 
                        value="{{ old('order', $project->order) }}"
                        min="0"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                    >
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                        Lower numbers appear first
                    </p>
                </div>
            </div>
            
            {{-- Project Details --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-6">Project Details</h3>
                
                {{-- Start Date --}}
                <div class="mb-6">
                    <label for="start_date" class="block text-sm font-medium mb-2">Start Date</label>
                    <input 
                        type="date" 
                        id="start_date" 
                        name="start_date" 
                        value="{{ old('start_date', $project->start_date?->format('Y-m-d')) }}"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                    >
                </div>
                
                {{-- End Date --}}
                <div class="mb-6">
                    <label for="end_date" class="block text-sm font-medium mb-2">End Date</label>
                    <input 
                        type="date" 
                        id="end_date" 
                        name="end_date" 
                        value="{{ old('end_date', $project->end_date?->format('Y-m-d')) }}"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                    >
                    @error('end_date')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                {{-- Client --}}
                <div>
                    <label for="client" class="block text-sm font-medium mb-2">Client / Company</label>
                    <input 
                        type="text" 
                        id="client" 
                        name="client" 
                        value="{{ old('client', $project->client) }}"
                        class="w-full px-4 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 border-0 focus:ring-2 focus:ring-primary-500"
                        placeholder="Client name (optional)"
                    >
                </div>
            </div>
            
            {{-- Stats --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <h3 class="text-lg font-semibold mb-4">Statistics</h3>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Views</span>
                        <span class="font-semibold">{{ number_format($project->views_count) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Created</span>
                        <span class="font-semibold">{{ $project->created_at->format('M d, Y') }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-500 dark:text-gray-400">Last Updated</span>
                        <span class="font-semibold">{{ $project->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
            
            {{-- Actions --}}
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
                <button type="submit" class="w-full px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors mb-3">
                    <i class="fas fa-save mr-2"></i>
                    Update Project
                </button>
                <a href="{{ route('admin.projects.index') }}" class="block w-full px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors text-center">
                    Cancel
                </a>
            </div>
            
            {{-- Danger Zone --}}
            <div class="bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-200 dark:border-red-900 p-6">
                <h3 class="text-lg font-semibold text-red-600 dark:text-red-400 mb-4">Danger Zone</h3>
                <p class="text-sm text-red-500 dark:text-red-400 mb-4">
                    Once you delete this project, it will be moved to trash. You can restore it within 30 days.
                </p>
                <button 
                    type="button"
                    x-data
                    @click="if(confirm('Are you sure you want to delete this project?')) { $refs.deleteForm.submit() }"
                    class="w-full px-4 py-2 bg-red-500 text-white rounded-xl font-semibold hover:bg-red-600 transition-colors"
                >
                    <i class="fas fa-trash mr-2"></i>
                    Delete Project
                </button>
            </div>
</form>

<form x-ref="deleteForm" action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>
        </div>
    </div>
@endsection

@push('scripts')
<script>
function projectForm() {
    return {
        featuredImagePreview: null,
        galleryPreviews: [],
        
        handleFeaturedImageChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.featuredImagePreview = URL.createObjectURL(file);
            }
        },
        
        handleFeaturedImageDrop(event) {
            event.target.classList.remove('border-primary-500');
            const file = event.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                this.$refs.featuredImage.files = event.dataTransfer.files;
                this.featuredImagePreview = URL.createObjectURL(file);
            }
        },
        
        handleGalleryChange(event) {
            const files = Array.from(event.target.files);
            files.forEach(file => {
                if (file.type.startsWith('image/')) {
                    this.galleryPreviews.push(URL.createObjectURL(file));
                }
            });
        },
        
        removeGalleryImage(index) {
            this.galleryPreviews.splice(index, 1);
        }
    }
}
</script>
@endpush
