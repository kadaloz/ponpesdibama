<?php $__env->startSection('title', $news->title . ' - Berita PonpesDIBAMA'); ?>

<?php $__env->startSection('main_content'); ?>
    <!-- Hero Section -->
    <section class="py-20 md:py-28 bg-gradient-to-r from-teal-700 to-green-600 text-white text-center rounded-b-3xl shadow-xl">
        <div class="container mx-auto px-4">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 drop-shadow-lg"><?php echo e($news->title); ?></h1>
            <p class="text-sm md:text-base text-white opacity-80 italic">
                Dipublikasi pada <?php echo e($news->published_at ? \Carbon\Carbon::parse($news->published_at)->translatedFormat('d F Y H:i') : 'Tanggal Tidak Tersedia'); ?> WIB
            </p>
        </div>
    </section>

    <!-- News Content -->
    <section class="py-16 bg-white px-6 md:px-0 mx-auto max-w-5xl animate-fade-in-up">
        <div class="px-4 md:px-8">
            <?php if($news->image): ?>
                <div class="mb-10">
                    <img src="<?php echo e(asset('storage/' . $news->image)); ?>" alt="<?php echo e($news->title); ?>" class="w-full max-h-[450px] object-cover rounded-xl shadow-md border border-gray-100">
                </div>
            <?php endif; ?>

            <article class="prose prose-lg lg:prose-xl max-w-none text-gray-800 leading-relaxed text-justify">
                <?php echo $news->content; ?>

            </article>

            <div class="mt-12 text-center border-t pt-6">
                <a href="<?php echo e(route('news.index_public')); ?>" class="inline-flex items-center px-6 py-3 bg-teal-600 text-white text-sm font-semibold rounded-full shadow-md hover:bg-teal-700 transition-all hover:scale-105">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-arrow-left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5 mr-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?> Kembali ke Daftar Berita
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.apps', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/web/news/show.blade.php ENDPATH**/ ?>