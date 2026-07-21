@extends('layouts.app')

@section('title', $product->meta_title)
@section('meta_description', $product->meta_description)

@push('meta')
<meta property="og:title" content="{{ $product->meta_title }}">
<meta property="og:description" content="{{ $product->meta_description }}">
<meta property="og:image" content="{{ asset('storage/' . $product->image) }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="product">
@endpush

@section('content')
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-2">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Products</a></li>
            <li class="breadcrumb-item"><a href="{{ route('products.index', ['category' => $product->category->slug]) }}">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </div>
</nav>

<!-- Product Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-6 mb-4">
                <div class="sticky-top product-image-sticky">
                    <div class="card border-0 shadow-sm overflow-hidden">
                        <img src="{{ asset('storage/' . $product->image) }}"
                             class="card-img-top rounded w-100"
                             alt="{{ $product->name }}"
                             style="max-height: 500px; height: auto; object-fit: contain; background-color: #f8f9fa;">
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="badge bg-primary fs-6">{{ $product->category->name }}</span>
                </div>

                <h1 class="display-5 fw-bold mb-3">{{ $product->name }}</h1>

                <div class="mb-4">
                    <span class="h2 text-primary fw-bold">${{ number_format($product->price, 2) }}</span>
                    <span class="badge bg-success ms-2">In Stock</span>
                </div>

                <div class="mb-4">
                    <h5>Product Description</h5>
                    <div class="text-muted">
                        {!! $product->description !!}
                    </div>
                </div>

                <!-- Product Features -->
                <div class="card bg-light mb-4">
                    <div class="card-body">
                        <h6 class="card-title mb-3">
                            <i class="fas fa-star text-warning me-2"></i>Key Features
                        </h6>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Premium Quality Materials
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Industry Standard Specifications
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Extensive Testing & Quality Control
                            </li>
                            <li class="mb-0">
                                <i class="fas fa-check-circle text-success me-2"></i>
                                Professional Grade Performance
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="d-flex flex-column flex-md-row gap-3 mb-4">
                    <a href="{{ route('contact.index') }}" class="btn btn-primary btn-lg flex-fill">
                        <i class="fas fa-envelope me-2"></i>Request Quote
                    </a>
                    <button type="button" class="btn btn-outline-primary btn-lg flex-fill" onclick="shareProduct()">
                        <i class="fas fa-share-alt me-2"></i>Share Product
                    </button>
                </div>

                <!-- Contact Info -->
                <div class="card border-primary">
                    <div class="card-body text-center">
                        <h6 class="card-title">Need More Information?</h6>
                        <p class="card-text text-muted mb-3">Contact our sales team for detailed specifications and bulk pricing.</p>
                        <a href="{{ route('contact.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-phone me-2"></i>Contact Sales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
@if($relatedProducts->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Related Products</h2>
        <div class="row">
            @foreach($relatedProducts as $relatedProduct)
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card product-card h-100">
                    <img src="{{ asset('storage/' . $relatedProduct->image) }}"
                         class="card-img-top"
                         alt="{{ $relatedProduct->name }}"
                         style="height: 200px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-primary mb-2 align-self-start">{{ $relatedProduct->category->name }}</span>
                        <h5 class="card-title">{{ $relatedProduct->name }}</h5>
                        <p class="card-text text-muted small flex-grow-1">
                            {{ Str::limit(strip_tags($relatedProduct->description), 80) }}
                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="h6 mb-0 text-primary">${{ number_format($relatedProduct->price, 2) }}</span>
                            <a href="{{ route('products.show', $relatedProduct->slug) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@push('scripts')
<script>
function shareProduct() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $product->name }}',
            text: '{{ $product->meta_description }}',
            url: window.location.href
        }).then(() => {
            console.log('Product shared successfully');
        }).catch((error) => {
            console.log('Error sharing:', error);
            fallbackShare();
        });
    } else {
        fallbackShare();
    }
}

function fallbackShare() {
    const url = window.location.href;
    const text = 'Check out this product: {{ $product->name }}';

    if (navigator.clipboard) {
        navigator.clipboard.writeText(url).then(() => {
            alert('Product link copied to clipboard!');
        });
    } else {
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = url;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        alert('Product link copied to clipboard!');
    }
}
</script>
@endpush
@endsection
