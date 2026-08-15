<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title><?php echo e($title ?? config('app.name')); ?></title>


<link rel="icon" type="image/svg+xml" href="<?php echo e(asset('favicon.svg')); ?>">
<link rel="icon" type="image/png" href="<?php echo e(asset('favicon.png')); ?>" sizes="32x32">
<link rel="shortcut icon" href="<?php echo e(asset('favicon.ico')); ?>">
<link rel="apple-touch-icon" href="<?php echo e(asset('apple-touch-icon.png')); ?>">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

<?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

<?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
<?php echo app('flux')->fluxAppearance(); ?><?php /**PATH /var/www/indonesia-luxe/resources/views/partials/head.blade.php ENDPATH**/ ?>