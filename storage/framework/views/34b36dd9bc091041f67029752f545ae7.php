<?php $__env->startSection('title', 'News & Updates'); ?>

<?php $__env->startSection('content'); ?>
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
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="text-white-50">Home</a></li>
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
                           name="search" value="<?php echo e(request('search')); ?>">
                    <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
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
                            <a href="<?php echo e(route('news.index')); ?>"
                               class="btn <?php echo e(!request('category') ? 'btn-primary' : 'btn-outline-primary'); ?> btn-sm">
                                All Categories
                            </a>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('news.index', ['category' => $category->slug, 'search' => request('search')])); ?>"
                               class="btn <?php echo e(request('category') == $category->slug ? 'btn-primary' : 'btn-outline-primary'); ?> btn-sm">
                                <?php echo e($category->name); ?>

                                <span class="badge bg-light text-dark ms-1"><?php echo e($category->news_count); ?></span>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
        <?php if($news->count() > 0): ?>
            <!-- Results Info -->
            <div class="row mb-4">
                <div class="col-12">
                    <p class="text-muted mb-0">
                        Showing <?php echo e($news->firstItem()); ?> - <?php echo e($news->lastItem()); ?> of <?php echo e($news->total()); ?> articles
                        <?php if(request('search')): ?>
                            for "<strong><?php echo e(request('search')); ?></strong>"
                        <?php endif; ?>
                        <?php if(request('category')): ?>
                            in "<strong><?php echo e($categories->where('slug', request('category'))->first()?->name); ?></strong>"
                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <!-- News Grid -->
            <div class="row">
                <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card news-card h-100">
                        <div class="position-relative">
                            <img src="<?php echo e(asset('storage/' . $article->featured_image)); ?>"
                                 class="card-img-top"
                                 alt="<?php echo e($article->title); ?>"
                                 style="height: 250px; object-fit: cover;"
                                 loading="lazy">
                            <span class="badge bg-secondary position-absolute top-0 start-0 m-2">
                                <?php echo e($article->category->name); ?>

                            </span>
                            <div class="position-absolute bottom-0 start-0 m-2">
                                <small class="bg-dark text-white px-2 py-1 rounded">
                                    <i class="fas fa-calendar me-1"></i><?php echo e($article->created_at->format('M j, Y')); ?>

                                </small>
                            </div>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo e($article->title); ?></h5>
                            <p class="card-text text-muted flex-grow-1">
                                <?php echo e(Str::limit(strip_tags($article->description), 120)); ?>

                            </p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-eye me-1"></i><?php echo e(number_format($article->view_count)); ?>

                                        <i class="fas fa-heart ms-2 me-1"></i><?php echo e(number_format($article->like_count)); ?>

                                        <i class="fas fa-comments ms-2 me-1"></i><?php echo e($article->comments()->count()); ?>

                                    </small>
                                </div>
                                <a href="<?php echo e(route('news.show', $article->slug)); ?>"
                                   class="btn btn-primary w-100">
                                    <i class="fas fa-arrow-right me-2"></i>Read More
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12 d-flex justify-content-center">
                    <?php echo e($news->withQueryString()->links()); ?>

                </div>
            </div>

        <?php else: ?>
            <!-- No News Found -->
            <div class="text-center py-5">
                <i class="fas fa-newspaper display-1 text-muted mb-4"></i>
                <h3 class="mb-3">No Articles Found</h3>
                <p class="text-muted mb-4">
                    <?php if(request('search') || request('category')): ?>
                        No articles match your current filters. Try adjusting your search criteria.
                    <?php else: ?>
                        No articles are currently available. Please check back later.
                    <?php endif; ?>
                </p>
                <a href="<?php echo e(route('news.index')); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>View All News
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel\3smarkerting\my_project_name\resources\views/news/index.blade.php ENDPATH**/ ?>