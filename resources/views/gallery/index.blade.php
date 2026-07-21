@extends('layouts.app')

@section('title', 'Gallery')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-0">Gallery</h1>
                <p class="mb-0">Explore our collection of images</p>
            </div>
            <div class="col-md-4 text-md-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Gallery</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="py-5">
    <div class="container">
        @if($images->count() > 0)
            <!-- Results Info -->
            <div class="row mb-4">
                <div class="col-12">
                    <p class="text-muted mb-0">
                        Showing {{ $images->firstItem() }} - {{ $images->lastItem() }} of {{ $images->total() }} images
                    </p>
                </div>
            </div>

            <!-- Gallery Grid -->
            <div class="row" x-data="gallery()">
                @foreach($images as $image)
                <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                    <div class="gallery-item position-relative">
                        <img src="{{ asset('storage/' . $image->image) }}"
                             class="img-fluid rounded shadow-sm w-100"
                             alt="{{ $image->title }}"
                             style="height: 250px; object-fit: cover; cursor: pointer;"
                             loading="lazy"
                             @click="openModal('{{ asset('storage/' . $image->image) }}', '{{ $image->title }}')">

                        @if($image->title)
                        <div class="position-absolute bottom-0 start-0 end-0 bg-dark bg-opacity-75 text-white p-2 rounded-bottom">
                            <small>{{ $image->title }}</small>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach

                <!-- Image Modal -->
                <div class="modal fade" id="imageModal" tabindex="-1" x-show="showModal" x-transition>
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content bg-transparent border-0">
                            <div class="modal-body p-0 text-center">
                                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-index-1"
                                        @click="closeModal()" style="z-index: 1051;"></button>
                                <img :src="modalImage" :alt="modalTitle" class="img-fluid rounded"
                                     style="max-height: 90vh; max-width: 100%;">
                                <div class="text-white mt-2" x-show="modalTitle" x-text="modalTitle"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $images->links() }}
                </div>
            </div>

        @else
            <!-- No Images Found -->
            <div class="text-center py-5">
                <i class="fas fa-images display-1 text-muted mb-4"></i>
                <h3 class="mb-3">No Images Available</h3>
                <p class="text-muted mb-4">No images are currently available in our gallery. Please check back later.</p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    <i class="fas fa-home me-2"></i>Back to Home
                </a>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
function gallery() {
    return {
        showModal: false,
        modalImage: '',
        modalTitle: '',

        openModal(imageSrc, imageTitle) {
            this.modalImage = imageSrc;
            this.modalTitle = imageTitle || '';
            this.showModal = true;
            document.body.style.overflow = 'hidden';
        },

        closeModal() {
            this.showModal = false;
            document.body.style.overflow = 'auto';
        }
    }
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        Alpine.store('gallery')?.closeModal();
    }
});
</script>
@endpush
@endsection
