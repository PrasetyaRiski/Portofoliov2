@extends('layouts.admin')

@section('title', 'Settings')
@section('page-title', 'Settings')

@section('content')
{{-- Page Header --}}
<div class="flex items-center justify-between mb-8">
    <div>
        <nav class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-500">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-900 dark:text-gray-100">Settings</span>
        </nav>
        <h2 class="text-2xl font-bold">Profile Settings</h2>
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-8">
    {{-- Avatar Section --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold mb-6 flex items-center gap-2">
            <i class="fas fa-user-circle text-primary-500"></i>
            Profile Avatar
        </h3>
        
        {{-- Current Avatar Preview --}}
        <div class="flex flex-col items-center mb-6">
            <div class="relative group">
                <img 
                    id="avatar-preview"
                    src="{{ $currentAvatar }}" 
                    alt="Current Avatar" 
                    class="w-40 h-40 rounded-full object-cover border-4 border-primary-500/20 shadow-lg"
                >
                <div class="absolute inset-0 rounded-full bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <i class="fas fa-camera text-white text-2xl"></i>
                </div>
            </div>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">Current profile avatar</p>
        </div>
        
        {{-- Upload Form --}}
        <form action="{{ route('admin.settings.avatar.update') }}" method="POST" enctype="multipart/form-data" x-data="avatarUpload()">
            @csrf
            @method('PUT')
            
            <div 
                class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-xl p-6 text-center hover:border-primary-500 transition-colors cursor-pointer mb-4"
                x-on:click="$refs.avatarInput.click()"
                x-on:dragover.prevent="$event.target.classList.add('border-primary-500', 'bg-primary-50')"
                x-on:dragleave.prevent="$event.target.classList.remove('border-primary-500', 'bg-primary-50')"
                x-on:drop.prevent="handleDrop($event)"
            >
                <template x-if="previewUrl">
                    <div>
                        <img :src="previewUrl" class="w-32 h-32 rounded-full object-cover mx-auto mb-3 border-2 border-primary-500">
                        <p class="text-sm text-primary-500 font-medium">New avatar selected</p>
                        <p class="text-xs text-gray-400 mt-1" x-text="fileName"></p>
                    </div>
                </template>
                <template x-if="!previewUrl">
                    <div>
                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                        <p class="text-gray-600 dark:text-gray-400 mb-1">Drag and drop or click to upload</p>
                        <p class="text-sm text-gray-400">JPG, PNG, GIF, WebP up to 5MB</p>
                    </div>
                </template>
            </div>
            
            <input 
                type="file" 
                name="avatar" 
                x-ref="avatarInput"
                @change="handleFileChange($event)"
                accept="image/jpeg,image/png,image/gif,image/webp"
                class="hidden"
            >
            
            @error('avatar')
            <p class="text-sm text-red-500 mb-4">{{ $message }}</p>
            @enderror
            
            <div class="flex gap-3">
                <button 
                    type="submit" 
                    x-show="previewUrl"
                    class="flex-1 px-6 py-3 bg-primary-500 text-white rounded-xl font-semibold hover:bg-primary-600 transition-colors"
                >
                    <i class="fas fa-save mr-2"></i>
                    Save Avatar
                </button>
                <button 
                    type="button" 
                    x-show="previewUrl"
                    @click="clearPreview()"
                    class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:bg-gray-300 dark:hover:bg-gray-600 transition-colors"
                >
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </form>
        
        {{-- Remove Avatar --}}
        <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
            <form action="{{ route('admin.settings.avatar.remove') }}" method="POST" onsubmit="return confirm('Are you sure you want to remove your avatar?');">
                @csrf
                @method('DELETE')
                <button 
                    type="submit" 
                    class="w-full px-6 py-3 bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400 rounded-xl font-semibold hover:bg-red-100 dark:hover:bg-red-900/40 transition-colors"
                >
                    <i class="fas fa-trash mr-2"></i>
                    Remove Avatar
                </button>
            </form>
        </div>
    </div>
    
    {{-- Profile Info Section --}}
    <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
        <h3 class="text-lg font-semibold mb-6 flex items-center gap-2">
            <i class="fas fa-info-circle text-primary-500"></i>
            Profile Information
        </h3>
        
        <div class="space-y-4">
            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <i class="fas fa-user text-primary-500 w-5"></i>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Name</p>
                    <p class="font-semibold">{{ config('portfolio.owner.name') }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <i class="fas fa-envelope text-primary-500 w-5"></i>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Email</p>
                    <p class="font-semibold">{{ config('portfolio.owner.email') }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <i class="fas fa-briefcase text-primary-500 w-5"></i>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Title</p>
                    <p class="font-semibold">{{ config('portfolio.owner.title') }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <i class="fas fa-university text-primary-500 w-5"></i>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">University</p>
                    <p class="font-semibold">{{ config('portfolio.owner.university') }}</p>
                </div>
            </div>
            
            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                <i class="fas fa-map-marker-alt text-primary-500 w-5"></i>
                <div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">Location</p>
                    <p class="font-semibold">{{ config('portfolio.owner.location') }}</p>
                </div>
            </div>
        </div>
        
        <div class="mt-6 p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-xl">
            <p class="text-sm text-yellow-700 dark:text-yellow-400">
                <i class="fas fa-info-circle mr-2"></i>
                To update profile information, edit the <code class="bg-yellow-100 dark:bg-yellow-900/40 px-1 rounded">.env</code> file or <code class="bg-yellow-100 dark:bg-yellow-900/40 px-1 rounded">config/portfolio.php</code>
            </p>
        </div>
    </div>
</div>

{{-- Storage Sync Section (for cPanel hosting) --}}
@if($needsSync ?? false)
<div class="mt-8 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-6">
    <h3 class="text-lg font-semibold mb-4 flex items-center gap-2">
        <i class="fas fa-sync-alt text-orange-500"></i>
        Storage Sync (cPanel Hosting)
    </h3>
    
    <div class="p-4 bg-orange-50 dark:bg-orange-900/20 rounded-xl mb-4">
        <p class="text-sm text-orange-700 dark:text-orange-400">
            <i class="fas fa-exclamation-triangle mr-2"></i>
            <strong>Symlink tidak aktif.</strong> Jika gambar tidak tampil setelah upload, gunakan tombol di bawah untuk menyinkronkan file storage ke folder public.
        </p>
    </div>
    
    <form action="{{ route('admin.settings.storage-sync') }}" method="POST">
        @csrf
        <button 
            type="submit" 
            class="px-6 py-3 bg-orange-500 text-white rounded-xl font-semibold hover:bg-orange-600 transition-colors"
        >
            <i class="fas fa-sync-alt mr-2"></i>
            Sync Storage Files
        </button>
    </form>
</div>
@endif
@endsection

@push('scripts')
<script>
function avatarUpload() {
    return {
        previewUrl: null,
        fileName: '',
        
        handleFileChange(event) {
            const file = event.target.files[0];
            if (file) {
                this.previewUrl = URL.createObjectURL(file);
                this.fileName = file.name;
            }
        },
        
        handleDrop(event) {
            event.target.classList.remove('border-primary-500', 'bg-primary-50');
            const file = event.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                this.$refs.avatarInput.files = event.dataTransfer.files;
                this.previewUrl = URL.createObjectURL(file);
                this.fileName = file.name;
            }
        },
        
        clearPreview() {
            this.previewUrl = null;
            this.fileName = '';
            this.$refs.avatarInput.value = '';
        }
    }
}
</script>
@endpush
