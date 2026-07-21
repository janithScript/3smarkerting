<?php $__env->startSection('title', $product->meta_title); ?>
<?php $__env->startSection('meta_description', $product->meta_description); ?>

<?php $__env->startPush('meta'); ?>
<meta property="og:title" content="<?php echo e($product->meta_title); ?>">
<meta property="og:description" content="<?php echo e($product->meta_description); ?>">
<meta property="og:image" content="<?php echo e(asset('storage/' . $product->image)); ?>">
<meta property="og:url" content="<?php echo e(url()->current()); ?>">
<meta property="og:type" content="product">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<!-- Breadcrumb -->
<nav aria-label="breadcrumb" class="bg-light py-2">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>">Home</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('products.index')); ?>">Products</a></li>
            <li class="breadcrumb-item"><a href="<?php echo e(route('products.index', ['category' => $product->category->slug])); ?>"><?php echo e($product->category->name); ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e($product->name); ?></li>
        </ol>
    </div>
</nav>

<!-- Product Details -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Product Image -->
            <div class="col-lg-6 mb-4">
                <div class="sticky-top" style="top: 2rem;">
                    <div class="card border-0 shadow-sm">
                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>"
                             class="card-img-top rounded"
                             alt="<?php echo e($product->name); ?>"
                             style="height: 500px; object-fit: cover;">
                    </div>
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="mb-3">
                    <span class="badge bg-primary fs-6"><?php echo e($product->category->name); ?></span>
                </div>

                <h1 class="display-5 fw-bold mb-3"><?php echo e($product->name); ?></h1>

                <div class="mb-4">
                    <span class="h2 text-primary fw-bold">$<?php echo e(number_format($product->price, 2)); ?></span>
                    <span class="badge bg-success ms-2">In Stock</span>
                </div>

                <div class="mb-4">
                    <h5>Product Description</h5>
                    <div class="text-muted">
                        <?php echo $product->description; ?>

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
                    <a href="<?php echo e(route('contact.index')); ?>" class="btn btn-primary btn-lg flex-fill">
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
                        <a href="<?php echo e(route('contact.index')); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-phone me-2"></i>Contact Sales
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<?php if($relatedProducts->count() > 0): ?>
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Related Products</h2>
        <div class="row">
            <?php $__currentLoopData = $relatedProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relatedProduct): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card product-card h-100">
                    <img src="<?php echo e(asset('storage/' . $relatedProduct->image)); ?>"
                         class="card-img-top"
                         alt="<?php echo e($relatedProduct->name); ?>"
                         style="height: 200px; object-fit: cover;"
                         loading="lazy">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-primary mb-2 align-self-start"><?php echo e($relatedProduct->category->name); ?></span>
                        <h5 class="card-title"><?php echo e($relatedProduct->name); ?></h5>
                        <p class="card-text text-muted small flex-grow-1">
                            <?php echo e(Str::limit(strip_tags($relatedProduct->description), 80)); ?>

                        </p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="h6 mb-0 text-primary">$<?php echo e(number_format($relatedProduct->price, 2)); ?></span>
                            <a href="<?php echo e(route('products.show', $relatedProduct->slug)); ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>View
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php $__env->startPush('scripts'); ?>
<script>
function shareProduct() {
    if (navigator.share) {
        navigator.share({
            title: '<?php echo e($product->name); ?>',
            text: '<?php echo e($product->meta_description); ?>',
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
    const text = 'Check out this product: <?php echo e($product->name); ?>';

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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel\3smarkerting\my_project_name\resources\views/products/show.blade.php ENDPATH**/ ?>