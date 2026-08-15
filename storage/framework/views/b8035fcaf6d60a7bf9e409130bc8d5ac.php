<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark">

<head>
    <?php echo $__env->make('partials.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</head>

<body class="min-h-screen relative flex items-center justify-center px-4 py-12"
    x-data="{
        activeIndex: 0,
        totalImages: 6,
        init() {
            setInterval(() => {
                this.activeIndex = (this.activeIndex + 1) % this.totalImages;
            }, 3000); // 3 seconds interval for a smoother cycle
        }
    }">
    <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" :class="activeIndex === 0 ? 'opacity-100' : 'opacity-0'" style="background-image: url(&quot;https://images.unsplash.com/photo-1594805938422-b330ad42a7bb?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxCYWxpJTIwdHJvcGljYWwlMjBiZWFjaCUyMGx1eHVyeSUyMHJlc29ydHxlbnwxfHx8fDE3NzIwMzU1NTJ8MA&amp;ixlib=rb-4.1.0&amp;q=80&amp;w=1080&quot;); background-size: cover; background-position: center center;"></div>
    <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" :class="activeIndex === 1 ? 'opacity-100' : 'opacity-0'" style="background-image: url(&quot;https://images.unsplash.com/photo-1559628233-e9287b161a30?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxNb3VudCUyMEJyb21vJTIwc3VucmlzZSUyMHZvbGNhbm8lMjBKYXZhfGVufDF8fHx8MTc3MjAzNTU1M3ww&amp;ixlib=rb-4.1.0&amp;q=80&amp;w=1080&quot;); background-size: cover; background-position: center center;"></div>
    <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" :class="activeIndex === 2 ? 'opacity-100' : 'opacity-0'" style="background-image: url(&quot;https://images.unsplash.com/photo-1696855179868-9c40f02b4706?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxSYWphJTIwQW1wYXQlMjBkaXZpbmclMjB1bmRlcndhdGVyJTIwY29yYWx8ZW58MXx8fHwxNzcyMDM1NTUyfDA&amp;ixlib=rb-4.1.0&amp;q=80&amp;w=1080&quot;); background-size: cover; background-position: center center;"></div>
    <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" :class="activeIndex === 3 ? 'opacity-100' : 'opacity-0'" style="background-image: url(&quot;https://images.unsplash.com/photo-1694271486260-1a1859d4c745?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxLb21vZG8lMjBpc2xhbmQlMjBhZHZlbnR1cmUlMjBoa2ltaW5n8ZW58MXx8fHwxNzcyMDM1NTUzfDA&amp;ixlib=rb-4.1.0&amp;q=80&amp;w=1080&quot;); background-size: cover; background-position: center center;"></div>
    <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" :class="activeIndex === 4 ? 'opacity-100' : 'opacity-0'" style="background-image: url(&quot;https://images.unsplash.com/photo-1607672390383-aa666b4761ea?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxjYW1waW5nJTIwbW91bnRhaW4lMjB0ZW50JTIwbmF0dXJlfGVufDF8fHx8MTc3MjAzNTU1M3ww&amp;ixlib=rb-4.1.0&amp;q=80&amp;w=1080&quot;); background-size: cover; background-position: center center;"></div>
    <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out" :class="activeIndex === 5 ? 'opacity-100' : 'opacity-0'" style="background-image: url(&quot;https://images.unsplash.com/photo-1746211516723-c4cd447ec665?crop=entropy&amp;cs=tinysrgb&amp;fit=max&amp;fm=jpg&amp;ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxzbm9ya2VsaW5nJTIwdHJvcGljYWwlMjBvY2VhbiUyMGJsdWUlMjB3YXRlcnxlbnwxfHx8fDE3NzIwMzU1NTN8MA&amp;ixlib=rb-4.1.0&amp;q=80&amp;w=1080&quot;); background-size: cover; background-position: center center;"></div>
    <div class="absolute inset-0 bg-black/50 backdrop-blur-[2px]"></div>
    <?php echo e($slot); ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>

</html><?php /**PATH /var/www/indonesia-luxe/resources/views/layouts/auth/simple.blade.php ENDPATH**/ ?>