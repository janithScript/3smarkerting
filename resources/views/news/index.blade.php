@extends('layouts.app')

@section('title', 'News & Updates')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-0">News & Updates</h1>
                <p class="mb-0">Stay updated with our latest announcements and industry news</p>
            </div>
            <div class="col-md-4 text-md-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">News</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Search and Filters -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row align-items-center" x-data="{ showFilters: false }">
            <div class="col-md-6">
                <form method="GET" class="d-flex">
                    <input type="text" class="form-control me-2" placeholder="Search news..."
                           name="search" value="{{ request('search') }}">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <button @click="showFilters = !showFilters" class="btn btn-outline-primary">
                    <i class="fas fa-filter me-1"></i>Categories
                    <i class="fas" :class="showFilters ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
            </div>

            <!-- Categories Panel -->
            <div class="col-12 mt-3" x-show="showFilters" x-transition>
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Filter by Category</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="{{ route('news.index') }}"
                               class="btn {{ !request('category') ? 'btn-primary' : 'btn-outline-primary' }} btn-sm">
                                All Categories
                            </a>
                            @foreach($categories as $category)
                            <a href="{{ route('news.index', ['category' => $category->slug, 'search' => request('search')]) }}"
                               class="btn {{ request('category') == $category->slug ? 'btn-primary' : 'btn-outline-primary' }} btn-sm">
                                {{ $category->name }}
                                <span class="badge bg-light text-dark ms-1">{{ $category->news_count }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News Grid -->
<section class="py-5">
    <div class="container">
        @if($news->count() > 0)
            <!-- Results Info -->
            <div class="row mb-4">
                <div class="col-12">
                    <p class="text-muted mb-0">
                        Showing {{ $news->firstItem() }} - {{ $news->lastItem() }} of {{ $news->total() }} articles
                        @if(request('search'))
                            for "<strong>{{ request('search') }}</strong>"
                        @endif
                        @if(request('category'))
                            in "<strong>{{ $categories->where('slug', request('category'))->first()?->name }}</strong>"
                        @endif
                    </p>
                </div>
            </div>

            <!-- News Grid -->
            <div class="row">
                @foreach($news as $article)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card news-card h-100">
                        <div class="position-relative">
                            <img src="{{ asset('storage/' . $article->featured_image) }}"
                                 class="card-img-top"
                                 alt="{{ $article->title }}"
                                 style="height: 250px; object-fit: cover;"
                                 loading="lazy">
                            <span class="badge bg-secondary position-absolute top-0 start-0 m-2">
                                {{ $article->category->name }}
                            </span>
                            <div class="position-absolute bottom-0 start-0 m-2">
                                <small class="bg-dark text-white px-2 py-1 rounded">
                                    <i class="fas fa-calendar me-1"></i>{{ $article->created_at->format('M j, Y') }}
                                </small>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text text-muted flex-grow-1">
                                {{ Str::limit(strip_tags($article->description), 120) }}
                            </p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i>{{ number_format($article->view_count) }}
                                        <i class="fas fa-heart ms-2 me-1"></i>{{ number_format($article->like_count) }}
                                        <i class="fas fa-comments ms-2 me-1"></i>{{ $article->comments()->count() }}
                                    </small>
                                </div>
                                <a href="{{ route('news.show', $article->slug) }}"
                                   class="btn btn-primary w-100">
                                    <i class="fas fa-arrow-right me-2"></i>Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    {{ $news->withQueryString()->links() }}
                </div>
            </div>

        @else
            <!-- No News Found -->
            <div class="text-center py-5">
                <i class="fas fa-newspaper display-1 text-muted mb-4"></i>
                <h3 class="mb-3">No Articles Found</h3>
                <p class="text-muted mb-4">
                    @if(request('search') || request('category'))
                        No articles match your current filters. Try adjusting your search criteria.
                    @else
                        No articles are currently available. Please check back later.
                    @endif
                </p>
                <a href="{{ route('news.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>View All News
                </a>
            </div>
        @endif
    </div>
</section>
@endsection
