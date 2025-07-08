<?php $__env->startSection('title', 'Semua Berita & Pengumuman - Pondok Dibama'); ?>

<?php $__env->startSection('main_content'); ?>
    <!-- Hero Section -->
    <section class="py-20 md:py-28 bg-gradient-to-r from-teal-700 to-green-600 text-white rounded-b-3xl shadow-xl">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-extrabold mb-4 drop-shadow-lg">Semua Berita & Pengumuman</h1>
            <p class="text-xl md:text-2xl opacity-90 max-w-2xl mx-auto">
                Dapatkan informasi terbaru seputar kegiatan dan pengumuman resmi dari Ponpes DIBAMA.
            </p>
            <a href="<?php echo e(url('/')); ?>" class="mt-10 inline-flex items-center px-8 py-3 bg-white text-teal-700 text-base font-semibold rounded-full shadow-md hover:bg-teal-100 transition transform hover:scale-105">
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
<?php endif; ?> Kembali ke Beranda
            </a>
        </div>
    </section>

    <!-- Filter and Search Bar (Combined) -->
    <section class="bg-white border-b border-gray-100 shadow-sm py-6">
        <div class="container mx-auto px-4">
            <form method="GET" action="<?php echo e(route('news.index_public')); ?>" class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-2 w-full md:w-auto">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari berita..." class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                    <select name="category" class="px-8 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <option value="">Semua Kategori</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($category->slug); ?>" <?php echo e(request('category') == $category->slug ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button type="submit" class="bg-teal-600 text-white px-4 py-2 rounded-md hover:bg-teal-700 transition">Terapkan</button>
            </form>
        </div>
    </section>

    <!-- News Grid Section -->
    <section class="py-16 md:py-24 bg-white rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up">
        <div class="container mx-auto px-4">
            <?php if($allNews->isEmpty()): ?>
                <p class="text-gray-600 text-center py-8">Belum ada berita atau pengumuman yang dipublikasi.</p>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $allNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- News Card -->
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition-transform duration-300 hover:scale-105 hover:shadow-xl border border-gray-200">
                            <?php if($newsItem->image): ?>
                                <img src="<?php echo e(asset('storage/' . $newsItem->image)); ?>" alt="<?php echo e($newsItem->title); ?>" class="w-full h-48 object-cover">
                            <?php else: ?>
                                <img src="https://placehold.co/700x400/D5F5E3/000000?text=No+Image" alt="No Image" class="w-full h-48 object-cover">
                            <?php endif; ?>
                            <div class="p-6">
                                <span class="text-sm text-gray-500 block mb-2"><?php echo e($newsItem->published_at ? \Carbon\Carbon::parse($newsItem->published_at)->format('d F Y') : 'Tanggal Tidak Tersedia'); ?></span>
                                <h3 class="text-xl font-bold text-teal-700 my-2"><?php echo e($newsItem->title); ?></h3>
                                <p class="text-gray-700 text-base mb-4">
                                    <?php echo e(Str::limit(strip_tags($newsItem->content), 100)); ?>

                                </p>
                                <a href="<?php echo e(route('news.show', $newsItem->slug)); ?>" class="inline-flex items-center text-teal-600 hover:text-teal-800 font-semibold group transition-colors duration-200">
                                    Baca Selengkapnya
                                    <svg class="w-4 h-4 ml-2 transform transition-transform duration-200 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-12">
                    <?php echo e($allNews->withQueryString()->links('vendor.pagination.tailwind')); ?>

                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.apps', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/web/news/index_public.blade.php ENDPATH**/ ?>