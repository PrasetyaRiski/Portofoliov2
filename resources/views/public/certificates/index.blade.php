@extends('layouts.public')

@section('title', 'Certificates')
@section('description', 'View my professional certifications and achievements')

@section('content')
{{-- Hero Section --}}
<section class="py-20 relative overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center">
            <span class="inline-block px-4 py-2 bg-primary-100 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400 rounded-full text-sm font-medium mb-6 animate-fade-in">
                <i class="fas fa-certificate mr-2"></i>
                Certifications & Achievements
            </span>
            <h1 class="text-4xl md:text-5xl font-bold mb-6 animate-slide-up">
                My
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-500 to-secondary-500">
                    Certificates
                </span>
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 animate-slide-up animation-delay-200">
                Professional certifications and courses I've completed to enhance my skills
            </p>
        </div>
    </div>
</section>

{{-- Certificates Grid --}}
<section class="py-20">
    <div class="container mx-auto px-4">
        {{-- Category Filter --}}
        @if(!empty($categories))
        <div class="flex flex-wrap justify-center gap-3 mb-12" x-data="{ activeCategory: 'all' }">
            <button 
                @click="activeCategory = 'all'"
                :class="activeCategory === 'all' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300'"
                class="px-6 py-2 rounded-full font-medium transition-all hover:scale-105"
            >
                All
            </button>
            @foreach($categories as $key => $label)
            <button 
                @click="activeCategory = '{{ $key }}'"
                :class="activeCategory === '{{ $key }}' ? 'bg-primary-500 text-white' : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300'"
                class="px-6 py-2 rounded-full font-medium transition-all hover:scale-105"
            >
                {{ $label }}
            </button>
            @endforeach
        </div>
        @endif

        @if($certificates->count() > 0)
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($certificates as $certificate)
            <div 
                class="group relative bg-white dark:bg-gray-800 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700 hover:border-primary-500/50 transition-all duration-300 hover:shadow-xl hover:shadow-primary-500/10"
                data-category="{{ $certificate->category }}"
            >
                {{-- Certificate Image --}}
                <div class="aspect-[4/3] relative overflow-hidden bg-gradient-to-br from-primary-500/10 to-secondary-500/10 cursor-pointer"
                     @if($certificate->image) onclick="openLightbox('{{ $certificate->image_url }}', '{{ $certificate->title }}')" @endif>
                    @if($certificate->image)
                    <img 
                        src="{{ $certificate->image_url }}" 
                        alt="{{ $certificate->title }}"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                        loading="lazy"
                    >
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-3xl opacity-0 group-hover:opacity-100 transition-opacity"></i>
                    </div>
                    @else
                    <div class="w-full h-full flex items-center justify-center">
                        <i class="fas fa-certificate text-8xl text-primary-500/20"></i>
                    </div>
                    @endif
                    
                    {{-- Category Badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-white/90 dark:bg-gray-900/90 backdrop-blur-sm rounded-full text-sm font-medium">
                            {{ $certificate->category_label }}
                        </span>
                    </div>
                    
                    {{-- Featured Badge --}}
                    @if($certificate->is_featured)
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 bg-primary-500 text-white rounded-full text-sm font-medium">
                            <i class="fas fa-star mr-1"></i> Featured
                        </span>
                    </div>
                    @endif
                    
                    {{-- View Overlay --}}
                    @if($certificate->credential_url)
                    <a 
                        href="{{ $certificate->credential_url }}" 
                        target="_blank"
                        class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end justify-center pb-8 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                    >
                        <span class="px-6 py-3 bg-white text-gray-900 rounded-full font-medium hover:bg-primary-500 hover:text-white transition-colors">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            View Credential
                        </span>
                    </a>
                    @endif
                </div>
                
                {{-- Content --}}
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-2 group-hover:text-primary-500 transition-colors">
                        {{ $certificate->title }}
                    </h3>
                    
                    <p class="text-primary-500 font-medium mb-3">{{ $certificate->issuer }}</p>
                    
                    @if($certificate->description)
                    <p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2">
                        {{ $certificate->description }}
                    </p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        @if($certificates->hasPages())
        <div class="mt-12">
            {{ $certificates->links() }}
        </div>
        @endif

        @else
        {{-- Empty State --}}
        <div class="text-center py-20">
            <div class="w-20 h-20 mx-auto mb-6 rounded-full bg-gray-100 dark:bg-gray-800 flex items-center justify-center">
                <i class="fas fa-certificate text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-2xl font-bold mb-4">No Certificates Yet</h3>
            <p class="text-gray-600 dark:text-gray-400 mb-8">
                Certificates will appear here once added.
            </p>
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-primary-500 text-white rounded-full font-medium hover:bg-primary-600 transition-colors">
                <i class="fas fa-arrow-left"></i>
                Back to Home
            </a>
        </div>
        @endif
    </div>
</section>

{{-- CTA Section --}}
@if($certificates->count() > 0)
<section class="py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto bg-gradient-to-r from-primary-500 to-secondary-500 rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden">
            {{-- Background Pattern --}}
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">
                    Want to Work Together?
                </h2>
                <p class="text-xl opacity-90 mb-8 max-w-2xl mx-auto">
                    I'm always looking for new opportunities to learn and grow. Let's connect!
                </p>
                <a href="{{ route('contact.index') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-white text-primary-600 rounded-full font-semibold hover:bg-gray-100 transition-colors">
                    <i class="fas fa-envelope"></i>
                    Get in Touch
                </a>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Lightbox Modal for Certificate Preview --}}
<div id="lightbox" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/90 backdrop-blur-sm" onclick="closeLightbox(event)">
    <button onclick="closeLightbox(event)" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10">
        <i class="fas fa-times text-3xl"></i>
    </button>
    <div class="relative max-w-5xl max-h-[90vh] mx-4">
        <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[85vh] object-contain rounded-lg shadow-2xl">
        <p id="lightbox-title" class="text-white text-center mt-4 text-lg font-semibold"></p>
    </div>
</div>

<script>
function openLightbox(imageUrl, title) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxTitle = document.getElementById('lightbox-title');
    
    lightboxImage.src = imageUrl;
    lightboxImage.alt = title;
    lightboxTitle.textContent = title;
    
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(event) {
    if (event.target.id === 'lightbox' || event.target.closest('button')) {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    }
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const lightbox = document.getElementById('lightbox');
        if (!lightbox.classList.contains('hidden')) {
            lightbox.classList.add('hidden');
            lightbox.classList.remove('flex');
            document.body.style.overflow = '';
        }
    }
});
</script>
@endsection
