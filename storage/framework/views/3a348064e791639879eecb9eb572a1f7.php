<?php if(filled($brand = filament()->getBrandName())): ?>
    <div
        <?php echo e($attributes->class([
                'fi-logo text-xl font-bold leading-5 tracking-tight text-gray-950 dark:text-white',
            ])); ?>

    >
        <?php echo e($brand); ?>

    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\Laravel\3smarkerting\my_project_name\vendor\filament\filament\resources\views/components/logo.blade.php ENDPATH**/ ?>