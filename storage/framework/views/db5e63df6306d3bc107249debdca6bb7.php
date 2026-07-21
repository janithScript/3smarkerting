<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top" style="z-index: 1030;">
        <div class="container">
            <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
                <i class="fas fa-oil-can me-2"></i>3SMarketing
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">
                            <i class="fas fa-home me-1"></i>Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('about') ? 'active' : ''); ?>" href="<?php echo e(route('about')); ?>">
                            <i class="fas fa-info-circle me-1"></i>About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>" href="<?php echo e(route('products.index')); ?>">
                            <i class="fas fa-cubes me-1"></i>Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('news.*') ? 'active' : ''); ?>" href="<?php echo e(route('news.index')); ?>">
                            <i class="fas fa-newspaper me-1"></i>News
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('gallery.*') ? 'active' : ''); ?>" href="<?php echo e(route('gallery.index')); ?>">
                            <i class="fas fa-images me-1"></i>Gallery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo e(request()->routeIs('contact.*') ? 'active' : ''); ?>" href="<?php echo e(route('contact.index')); ?>">
                            <i class="fas fa-envelope me-1"></i>Contact
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav><?php /**PATH C:\xampp\htdocs\Laravel\3smarkerting\my_project_name\resources\views/components/navbar.blade.php ENDPATH**/ ?>