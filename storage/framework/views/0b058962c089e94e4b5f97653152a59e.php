<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<!-- Page Header -->
<section class="bg-primary text-white py-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-0">Our Products</h1>
                <p class="mb-0">Premium automotive solutions for every need</p>
            </div>
            <div class="col-md-4 text-md-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb bg-transparent mb-0">
                        <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>" class="text-white-50">Home</a></li>
                        <li class="breadcrumb-item active text-white" aria-current="page">Products</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</section>

<!-- Filters and Search -->
<section class="py-4 bg-light">
    <div class="container">
        <div class="row align-items-center" x-data="{ showFilters: false }">
            <div class="col-md-6">
                <form method="GET" class="d-flex">
                    <input type="text" class="form-control me-2" placeholder="Search products..."
                           name="search" value="<?php echo e(request('search')); ?>">
                    <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                <button @click="showFilters = !showFilters" class="btn btn-outline-primary">
                    <i class="fas fa-filter me-1"></i>Filters
                    <i class="fas" :class="showFilters ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                </button>
            </div>

            <!-- Filters Panel -->
            <div class="col-12 mt-3" x-show="showFilters" x-transition>
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title mb-3">Filter by Category</h6>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="<?php echo e(route('products.index')); ?>"
                               class="btn <?php echo e(!request('category') ? 'btn-primary' : 'btn-outline-primary'); ?> btn-sm">
                                All Categories
                            </a>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('products.index', ['category' => $category->slug, 'search' => request('search')])); ?>"
                               class="btn <?php echo e(request('category') == $category->slug ? 'btn-primary' : 'btn-outline-primary'); ?> btn-sm">
                                <?php echo e($category->name); ?>

                                <span class="badge bg-light text-dark ms-1"><?php echo e($category->products_count); ?></span>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Products Grid -->
<section class="py-5">
    <div class="container">
        <?php if($products->count() > 0): ?>
            <!-- Results Info -->
            <div class="row mb-4">
                <div class="col-12">
                    <p class="text-muted mb-0">
                        Showing <?php echo e($products->firstItem()); ?> - <?php echo e($products->lastItem()); ?> of <?php echo e($products->total()); ?> products
                        <?php if(request('search')): ?>
                            for "<strong><?php echo e(request('search')); ?></strong>"
                        <?php endif; ?>
                        <?php if(request('category')): ?>
                            in "<strong><?php echo e($categories->where('slug', request('category'))->first()?->name); ?></strong>"
                        <?php endif; ?>
                    </p>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="row">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="card product-card h-100">
                        <div class="position-relative">
                            <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                                 class="card-img-top"
                                 alt="<?php echo e($product->name); ?>"
                                 style="height: 250px; object-fit: cover;"
                                 loading="lazy">
                            <span class="badge bg-primary position-absolute top-0 start-0 m-2">
                                <?php echo e($product->category->name); ?>

                            </span>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?php echo e($product->name); ?></h5>
                            <p class="card-text text-muted flex-grow-1">
                                <?php echo e(Str::limit(strip_tags($product->description), 100)); ?>

                            </p>
                            <div class="mt-auto">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="h4 mb-0 text-primary">$<?php echo e(number_format($product->price, 2)); ?></span>
                                    <div class="badge bg-success">In Stock</div>
                                </div>
                                <a href="<?php echo e(route('products.show', $product->slug)); ?>"
                                   class="btn btn-primary w-100">
                                    <i class="fas fa-eye me-2"></i>View Details
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
                    <?php echo e($products->withQueryString()->links()); ?>

                </div>
            </div>

        <?php else: ?>
            <!-- No Products Found -->
            <div class="text-center py-5">
                <i class="fas fa-search display-1 text-muted mb-4"></i>
                <h3 class="mb-3">No Products Found</h3>
                <p class="text-muted mb-4">
                    <?php if(request('search') || request('category')): ?>
                        No products match your current filters. Try adjusting your search criteria.
                    <?php else: ?>
                        No products are currently available. Please check back later.
                    <?php endif; ?>
                </p>
                <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i>View All Products
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel\3smarkerting\my_project_name\resources\views/products/index.blade.php ENDPATH**/ ?>