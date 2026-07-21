<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startSection('content'); ?>
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Premium Automotive Products</h1>
                <p class="lead mb-4">Discover our comprehensive range of brake oils, radiator coolants, grease products, and lubricants designed for optimal automotive performance.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-light btn-lg">
                        <i class="fas fa-cubes me-2"></i>View Products
                    </a>
                    <a href="<?php echo e(route('contact.index')); ?>" class="btn btn-outline-light btn-lg">
                        <i class="fas fa-envelope me-2"></i>Contact Us
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center">
                <div class="hero-image mt-4 mt-lg-0">
                    <i class="fas fa-oil-can" style="font-size: 12rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<?php if($featuredProducts->count() > 0): ?>
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Featured Products</h2>
        <div class="row">
            <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card product-card h-100">
                    <img src="<?php echo e(asset('storage/' . $product->image)); ?>" class="card-img-top" alt="<?php echo e($product->name); ?>" style="height: 200px; object-fit: cover;" loading="lazy">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-primary mb-2 align-self-start"><?php echo e($product->category->name); ?></span>
                        <h5 class="card-title"><?php echo e($product->name); ?></h5>
                        <p class="card-text text-muted small flex-grow-1"><?php echo e(Str::limit(strip_tags($product->description), 80)); ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="h5 mb-0 text-primary">$<?php echo e(number_format($product->price, 2)); ?></span>
                            <a href="<?php echo e(route('products.show', $product->slug)); ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-eye me-1"></i>View Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-cubes me-2"></i>View All Products
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Latest News Section -->
<?php if($latestNews->count() > 0): ?>
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Latest News & Updates</h2>
        <div class="row">
            <?php $__currentLoopData = $latestNews->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card news-card h-100">
                    <img src="<?php echo e(asset('storage/' . $news->featured_image)); ?>" class="card-img-top" alt="<?php echo e($news->title); ?>" style="height: 200px; object-fit: cover;" loading="lazy">
                    <div class="card-body d-flex flex-column">
                        <span class="badge bg-secondary mb-2 align-self-start"><?php echo e($news->category->name); ?></span>
                        <h5 class="card-title"><?php echo e($news->title); ?></h5>
                        <p class="card-text text-muted small flex-grow-1"><?php echo e(Str::limit(strip_tags($news->description), 100)); ?></p>
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i><?php echo e(number_format($news->view_count)); ?>

                                <i class="fas fa-heart ms-2 me-1"></i><?php echo e(number_format($news->like_count)); ?>

                            </small>
                            <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-arrow-right me-1"></i>Read More
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo e(route('news.index')); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-newspaper me-2"></i>View All News
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Gallery Preview Section -->
<?php if($galleryImages->count() > 0): ?>
<section class="py-5">
    <div class="container">
        <h2 class="section-title">Gallery</h2>
        <div class="row">
            <?php $__currentLoopData = $galleryImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                <div class="gallery-item">
                    <img src="<?php echo e(asset('storage/' . $image->image)); ?>" class="img-fluid rounded" alt="<?php echo e($image->title); ?>" style="height: 200px; width: 100%; object-fit: cover;" loading="lazy">
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo e(route('gallery.index')); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-images me-2"></i>View Full Gallery
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Distributors Section -->
<?php if($distributors->count() > 0): ?>
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="section-title">Our Distributors</h2>
        <div class="row">
            <?php $__currentLoopData = $distributors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $distributor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i><?php echo e($distributor->name); ?>

                        </h5>
                        <p class="card-text text-muted mb-3"><?php echo e($distributor->covering_regions); ?></p>
                        <a href="tel:<?php echo e($distributor->phone_number); ?>" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-phone me-1"></i><?php echo e($distributor->phone_number); ?>

                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div class="text-center mt-4">
            <a href="<?php echo e(route('contact.index')); ?>" class="btn btn-primary btn-lg">
                <i class="fas fa-handshake me-2"></i>Become a Distributor
            </a>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Contact CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="mb-4">Ready to Get Started?</h2>
                <p class="lead mb-4">Contact us today to learn more about our premium automotive products and how we can meet your business needs.</p>
                <a href="<?php echo e(route('contact.index')); ?>" class="btn btn-light btn-lg">
                    <i class="fas fa-envelope me-2"></i>Get In Touch
                </a>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Laravel\3smarkerting\my_project_name\resources\views/pages/home.blade.php ENDPATH**/ ?>