<?php $__env->startSection('title', 'Beranda - Pondok Dibama'); ?>

<?php $__env->startSection('main_content'); ?>
<!-- Hero Section -->
<section id="beranda"
         class="relative bg-gradient-to-r from-teal-700 to-emerald-700 text-white py-16 sm:py-20 md:py-28 flex items-center justify-center min-h-[50vh] md:min-h-[60vh] lg:min-h-[70vh] rounded-b-3xl shadow-2xl overflow-hidden">

    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center opacity-10 blur-sm"
         style="background-image: url('https://placehold.co/1920x1080/000000/FFFFFF?text=@Bait+El+Makmur');">
    </div>

    <!-- Content -->
    <div class="relative z-10 text-center px-6 max-w-4xl mx-auto animate-fade-in-up">
<h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white text-center leading-tight tracking-tight drop-shadow-xl mb-10">
    <span class="block mb-1">Selamat Datang di</span>
    <span class="block text-yellow-300 mb-1">Website Resmi</span>
    <span class="block">Yayasan Pondok Pesantren</span>
    <span class="block text-yellow-300">Diniyah Baitul Makmur Aikmel</span>
</h1>

<p class="text-lg sm:text-xl md:text-2xl italic text-white/90 text-center leading-relaxed max-w-2xl mx-auto px-4 font-medium">
    <span class="block">Mendidik <span class="text-yellow-200 font-semibold">Generasi Qur'ani</span>,</span>
    <span class="block">Berakhlak <span class="text-yellow-200 font-semibold">Islami</span>,</span>
    <span class="block">untuk <span class="text-yellow-200 font-semibold">Membangun Negeri</span>.</span>
</p>

<a href="#program"
   class="inline-flex items-center justify-center mt-10 px-8 py-4 bg-white text-teal-700 font-semibold text-base md:text-lg rounded-full shadow-xl hover:bg-teal-50 transition-transform duration-300 transform hover:scale-105 ring-2 ring-white/30 animate-bounce">
    Lihat Program Kami
    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
         xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
    </svg>
</a>

    </div>
</section>



<!-- Redesigned Floating Navigation -->
<nav class="sticky top-[80px] z-40 mx-auto mt-6 max-w-max px-6 py-3 bg-white/80 backdrop-blur-md border border-gray-200 shadow-lg rounded-full transition-all duration-300 hover:shadow-xl">
    <ul class="flex flex-wrap justify-center items-center gap-2 md:gap-4 text-sm md:text-base font-medium text-teal-800">
        <li>
            <a href="#beranda" class="nav-link px-3 py-1.5 rounded-full hover:bg-teal-100 transition">Beranda</a>
        </li>
        <li>
            <a href="#tentang" class="nav-link px-3 py-1.5 rounded-full hover:bg-teal-100 transition">Tentang Kami</a>
        </li>
        <li>
            <a href="#program" class="nav-link px-3 py-1.5 rounded-full hover:bg-teal-100 transition">Program</a>
        </li>
        <li>
            <a href="#nasihat-harian" class="nav-link px-3 py-1.5 rounded-full hover:bg-teal-100 transition">Nasihat Harian</a>
        </li>
        <li>
            <a href="#berita" class="nav-link px-3 py-1.5 rounded-full hover:bg-teal-100 transition">Berita</a>
        </li>
        <?php if($isPpdbOpen): ?>
            <li>
                <a href="#pendaftaran" class="nav-link px-3 py-1.5 rounded-full bg-teal-600 text-white hover:bg-teal-700 transition">
                    Pendaftaran
                </a>
            </li>
        <?php endif; ?>
        <li>
            <a href="#galeri" class="nav-link px-3 py-1.5 rounded-full hover:bg-teal-100 transition">Galeri</a>
        </li>
        <li>
            <a href="#kontak" class="nav-link px-3 py-1.5 rounded-full hover:bg-teal-100 transition">Kontak</a>
        </li>
    </ul>
</nav>


<!-- About Us Section -->
<section id="tentang" class="py-20 md:py-32 bg-white rounded-3xl shadow-xl mx-auto max-w-7xl my-16">
    <div class="container mx-auto px-6">
        <!-- Heading -->
        <h2 class="text-center text-3xl md:text-4xl font-extrabold text-teal-700 mb-14 drop-shadow-sm">
            Profil Pondok Pesantren
        </h2>

        <!-- Content Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Image -->
            <div class="relative group overflow-hidden rounded-2xl shadow-2xl border-8 border-teal-200 transform transition duration-300 hover:scale-105">
                <?php if($pondokPhoto): ?>
                    <img src="<?php echo e(asset('storage/' . $pondokPhoto)); ?>" alt="Foto Pondok Dibama"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <?php else: ?>
                    <img src="https://placehold.co/600x400/AED6F1/000000?text=Gambar+Pondok+Utama"
                         alt="Gambar Pondok Dibama"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" />
                <?php endif; ?>
            </div>

            <!-- Text Content -->
            <div class="text-lg leading-relaxed text-gray-700">
                <div class="mb-6 prose max-w-none">
                    <?php echo $aboutUsContent; ?>

                </div>

                <!-- Highlighted Quote -->
                <blockquote class="pl-5 border-l-4 border-teal-600 italic text-teal-800 font-semibold mb-8">
                    <?php echo e($missionQuote); ?>

                </blockquote>

                <!-- Call to Action -->
                <a href="#kontak"
                   class="inline-flex items-center gap-2 px-8 py-4 rounded-full bg-teal-600 text-white font-semibold text-base shadow-lg hover:bg-teal-700 hover:scale-105 transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    <span>Bergabung Bersama Kami</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm.75-11.25a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z"
                              clip-rule="evenodd"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>


<!-- Key Features/Why Choose Us Section -->
<section class="py-20 md:py-32 bg-teal-50 rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up">
    <div class="container mx-auto px-6 text-center">
        <h2 class="section-title text-center text-3xl md:text-4xl font-bold text-teal-700 mb-12">Mengapa Memilih PonpesDIBAMA?</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Sanad Muttashil -->
            <div class="flex flex-col items-center p-8 bg-white rounded-2xl shadow-xl transform transition-transform duration-300 hover:scale-105 border border-teal-100">
                <div class="bg-teal-500 rounded-full p-4 mb-4 shadow-md">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-book-open'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-10 h-10 text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                </div>
                <h3 class="text-xl font-bold text-teal-700 mb-2">Sanad Al-Qur'an & Turots</h3>
                <p class="text-gray-700 text-center">Sanad yang Muttashil langsung bersambung hingga Rasulullah ﷺ.</p>
            </div>

            <!-- Adab, Ilmu, Akhlak -->
            <div class="flex flex-col items-center p-8 bg-white rounded-2xl shadow-xl transform transition-transform duration-300 hover:scale-105 border border-teal-100">
                <div class="bg-teal-500 rounded-full p-4 mb-4 shadow-md">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-academic-cap'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-10 h-10 text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                </div>
                <h3 class="text-xl font-bold text-teal-700 mb-2">Adab, Ilmu & Akhlak</h3>
                <p class="text-gray-700 text-center">Fokus utama pada pembentukan karakter islami yang beradab.</p>
            </div>

            <!-- Hafalan Mutqin -->
            <div class="flex flex-col items-center p-8 bg-white rounded-2xl shadow-xl transform transition-transform duration-300 hover:scale-105 border border-teal-100">
                <div class="bg-teal-500 rounded-full p-4 mb-4 shadow-md">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-clipboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-10 h-10 text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                </div>
                <h3 class="text-xl font-bold text-teal-700 mb-2">Hafalan Mutqin</h3>
                <p class="text-gray-700 text-center">Hafalan Al-Qur'an yang mutqin, kuat, dan terjaga dengan baik.</p>
            </div>

            <!-- Bahasa Arab -->
            <div class="flex flex-col items-center p-8 bg-white rounded-2xl shadow-xl transform transition-transform duration-300 hover:scale-105 border border-teal-100">
                <div class="bg-teal-500 rounded-full p-4 mb-4 shadow-md">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-language'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-10 h-10 text-white']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                </div>
                <h3 class="text-xl font-bold text-teal-700 mb-2">Bahasa Arab</h3>
                <p class="text-gray-700 text-center">Pembiasaan percakapan dan pembelajaran Bahasa Arab aktif.</p>
            </div>
        </div>
    </div>
</section>

<!-- Programs Section -->
<section id="program" class="py-20 md:py-32 bg-teal-50 rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up">
    <div class="container mx-auto px-4 md:px-6">
        <h2 class="text-center text-3xl md:text-4xl font-extrabold text-teal-700 mb-14 drop-shadow-sm">Program Pendidikan Unggulan</h2>

        <?php if($programs->count() <= 3): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if (isset($component)) { $__componentOriginal10c1d92132b4e0908fded85bf3f6d3aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal10c1d92132b4e0908fded85bf3f6d3aa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.program.card','data' => ['program' => $program]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('program.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['program' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($program)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal10c1d92132b4e0908fded85bf3f6d3aa)): ?>
<?php $attributes = $__attributesOriginal10c1d92132b4e0908fded85bf3f6d3aa; ?>
<?php unset($__attributesOriginal10c1d92132b4e0908fded85bf3f6d3aa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal10c1d92132b4e0908fded85bf3f6d3aa)): ?>
<?php $component = $__componentOriginal10c1d92132b4e0908fded85bf3f6d3aa; ?>
<?php unset($__componentOriginal10c1d92132b4e0908fded85bf3f6d3aa); ?>
<?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="swiper programSwiper px-1 md:px-4">
                <div class="swiper-wrapper">
                    <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <?php if (isset($component)) { $__componentOriginal10c1d92132b4e0908fded85bf3f6d3aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal10c1d92132b4e0908fded85bf3f6d3aa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.program.card','data' => ['program' => $program]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('program.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['program' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($program)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal10c1d92132b4e0908fded85bf3f6d3aa)): ?>
<?php $attributes = $__attributesOriginal10c1d92132b4e0908fded85bf3f6d3aa; ?>
<?php unset($__attributesOriginal10c1d92132b4e0908fded85bf3f6d3aa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal10c1d92132b4e0908fded85bf3f6d3aa)): ?>
<?php $component = $__componentOriginal10c1d92132b4e0908fded85bf3f6d3aa; ?>
<?php unset($__componentOriginal10c1d92132b4e0908fded85bf3f6d3aa); ?>
<?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Custom navigation -->
                <div class="flex justify-center mt-10 gap-6">
                    <button class="swiper-button-prev group transition-all">
                        <svg class="w-10 h-10 text-teal-600 group-hover:text-teal-800 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/>
                        </svg>
                    </button>
                    <button class="swiper-button-next group transition-all">
                        <svg class="w-10 h-10 text-teal-600 group-hover:text-teal-800 transition" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>



    <!-- Daily Advice Section -->
    <section id="nasihat-harian" class="py-20 md:py-32 bg-white rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up"> 
        <div class="container mx-auto px-6 text-center">
            <h2 class="section-title text-center text-3xl md:text-4xl font-bold text-teal-700 mb-12">Nasihat Harian ✨</h2>
            <div class="bg-teal-50 p-8 rounded-xl shadow-inner mb-6 min-h-[180px] flex items-center justify-center text-center text-lg md:text-xl text-gray-700 italic border border-teal-200">
                Klik tombol di bawah untuk mendapatkan nasihat atau kutipan inspiratif.
            </div>
            <button id="getDailyAdviceBtn" class="bg-teal-700 text-white px-8 py-4 rounded-full text-lg font-semibold hover:bg-teal-800 transition-colors shadow-lg flex items-center justify-center mx-auto transform hover:scale-105"> 
                Dapatkan Nasihat ✨
                <svg id="dailyAdviceSpinner" class="animate-spin h-5 w-5 text-white ml-3 hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </button>
            <div id="dailyAdviceOutput" class="mt-6 text-lg text-gray-800 font-medium text-center min-h-[100px]"></div>
        </div>
    </section>


<!-- News & Announcements Section -->
<section id="berita" class="py-20 md:py-32 bg-teal-50 rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up">
    <div class="container mx-auto px-6">
        <!-- Heading -->
        <h2 class="text-center text-3xl md:text-4xl font-bold text-teal-700 mb-12 drop-shadow-sm">Berita & Pengumuman Terbaru</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <?php $__empty_1 = true; $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <!-- News Card -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl overflow-hidden transition-transform duration-300 hover:scale-[1.02]">
                    <!-- News Image -->
                    <div class="w-full h-56 overflow-hidden">
                        <img
                            src="<?php echo e($newsItem->image ? asset('storage/' . $newsItem->image) : 'https://placehold.co/700x400/D5F5E3/000000?text=No+Image'); ?>"
                            alt="<?php echo e($newsItem->title); ?>"
                            class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                        >
                    </div>

                    <!-- News Content -->
                    <div class="p-6">
                        <span class="text-sm text-gray-500 block mb-2">
                            <?php echo e($newsItem->published_at ? \Carbon\Carbon::parse($newsItem->published_at)->format('d M Y') : 'Tanggal Tidak Tersedia'); ?>

                        </span>
                        <h3 class="text-xl font-bold text-teal-700 mb-2"><?php echo e($newsItem->title); ?></h3>
                        <p class="text-gray-600 leading-relaxed mb-4"><?php echo e(Str::limit(strip_tags($newsItem->content), 150)); ?></p>

                        <a href="<?php echo e(route('news.show', $newsItem->slug)); ?>"
                           class="inline-flex items-center text-teal-600 hover:text-teal-800 font-semibold group transition-all duration-200">
                            Baca Selengkapnya
                            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="col-span-full text-center text-gray-600 py-6 text-lg">Belum ada berita atau pengumuman terbaru.</p>
            <?php endif; ?>
        </div>

        <!-- CTA Button -->
        <div class="text-center mt-12">
            <a href="<?php echo e(url('/berita')); ?>"
               class="inline-flex items-center px-8 py-4 bg-teal-600 text-white font-semibold text-sm uppercase rounded-full tracking-wide shadow-lg hover:bg-teal-700 hover:scale-105 transition transform duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400">
                Lihat Semua Berita & Pengumuman
            </a>
        </div>
    </div>
</section>

 <!-- Call to Action for Enrollment (Moved after Pendaftaran Section) -->
    
    <?php if($isPpdbOpen): ?>
        <section id="pendaftaran" class="py-20 md:py-32 bg-teal-600 text-white text-center rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight drop-shadow-md">
                    <?php echo e($ctaEnrollmentHeading ?? 'Siapkan Masa Depan Gemilang Putra/Putri Anda Bersama PonpesDIBAMA!'); ?> 
                </h2>
                <p class="text-xl md:text-2xl mb-10 opacity-90">
                    Pendaftaran santri baru tahun ajaran <?php echo e($ppdbAcademicYear); ?> telah dibuka.
                </p>
                <a href="<?php echo e(route('ppdb.create')); ?>" class="inline-flex items-center justify-center bg-white text-teal-700 px-12 py-6 rounded-full text-xl font-bold shadow-2xl transition-all duration-300 transform hover:scale-110 ring-4 ring-white ring-opacity-50">
                    Daftar Sekarang!
                    <svg class="w-6 h-6 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </section>
    <?php else: ?>
        
        <section class="py-20 md:py-32 bg-gray-300 text-gray-800 text-center rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up">
            <div class="container mx-auto px-6">
                <h2 class="text-3xl md:text-5xl font-extrabold mb-6 leading-tight drop-shadow-md">
                    Informasi Lebih Lanjut
                </h2>
                <p class="text-xl md:text-2xl mb-10 opacity-90">
                    Anda dapat menghubungi kami untuk pertanyaan seputar pendaftaran atau informasi lainnya.
                </p>
                <a href="#kontak" class="inline-flex items-center px-8 py-4 bg-teal-500 text-white rounded-full text-lg font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">
                    Hubungi Kami
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.135a11.042 11.042 0 005.516 5.516l1.135-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.948V19a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path></svg>
                </a>
            </div>
        </section>
    <?php endif; ?>

<!-- Gallery Section -->
<section id="galeri" class="py-20 md:py-32 bg-white rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-16 animate-fade-in-up">
    <div class="container mx-auto px-6">
        <!-- Heading -->
        <h2 class="text-center text-3xl md:text-4xl font-bold text-teal-700 mb-12 drop-shadow-sm">Galeri Kegiatan Pondok</h2>

        <?php if($galleries->isEmpty()): ?>
            <p class="text-gray-600 text-center py-6 text-lg">Belum ada album galeri yang dipublikasi.</p>
        <?php else: ?>
            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-md hover:shadow-xl overflow-hidden transition-all duration-300 hover:scale-[1.02]">
                        <!-- Cover Image -->
                        <div class="w-full h-48 overflow-hidden">
                            <img
                                src="<?php echo e($gallery->cover_image ? asset('storage/' . $gallery->cover_image) : 'https://placehold.co/600x400/D5F5E3/000000?text=No+Cover'); ?>"
                                alt="<?php echo e($gallery->title); ?>"
                                class="w-full h-full object-cover transition-transform duration-300 hover:scale-105"
                            >
                        </div>

                        <!-- Text Content -->
                        <div class="p-6 text-center">
                            <h3 class="text-xl font-bold text-teal-700 mb-2"><?php echo e($gallery->title); ?></h3>
                            <p class="text-gray-600 text-base mb-4 leading-relaxed">
                                <?php echo e(Str::limit($gallery->description, 70)); ?>

                            </p>
                            <a href="<?php echo e(route('public.galleries.show', $gallery->slug)); ?>"
                               class="inline-flex items-center text-teal-600 hover:text-teal-800 font-semibold group transition-all duration-200">
                                Lihat Album (<?php echo e($gallery->images->count()); ?> Foto)
                                <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- CTA Button -->
            <div class="mt-12 text-center">
                <a href="<?php echo e(route('public.galleries.index')); ?>"
                   class="inline-flex items-center px-8 py-4 bg-teal-600 text-white font-semibold text-sm uppercase rounded-full tracking-wide shadow-lg hover:bg-teal-700 hover:scale-105 transition transform duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-400">
                    Lihat Semua Galeri
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>

    
<!-- Redesigned Contact Section with Inline WhatsApp Logo -->
<section id="kontak" class="py-24 bg-gradient-to-br from-teal-700 to-teal-800 text-white rounded-3xl shadow-xl mx-4 md:mx-auto max-w-7xl my-20 animate-fade-in-up">
    <div class="container mx-auto px-6">

        <!-- Section Title -->
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-extrabold drop-shadow-xl section-title">Hubungi Kami</h2>
            <p class="mt-4 text-lg text-teal-100">Kami siap membantu Anda dengan informasi dan layanan terbaik</p>
        </div>

        <!-- Contact Info -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 text-center text-base md:text-lg font-medium">
            <!-- Address -->
            <div class="flex flex-col items-center space-y-4">
                <div class="bg-yellow-400 bg-opacity-20 p-4 rounded-full shadow-md">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-map-pin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-10 h-10 text-yellow-300']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                </div>
                <p class="leading-relaxed max-w-xs"><?php echo e($contactAddress); ?></p>
            </div>

            <!-- Phone -->
            <div class="flex flex-col items-center space-y-4">
                <div class="bg-yellow-400 bg-opacity-20 p-4 rounded-full shadow-md">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-phone'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-10 h-10 text-yellow-300']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                </div>
                <p><?php echo e($contactPhone); ?></p>
            </div>

            <!-- Email -->
            <div class="flex flex-col items-center space-y-4">
                <div class="bg-yellow-400 bg-opacity-20 p-4 rounded-full shadow-md">
                    <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-envelope'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-10 h-10 text-yellow-300']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $attributes = $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c)): ?>
<?php $component = $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c; ?>
<?php unset($__componentOriginal643fe1b47aec0b76658e1a0200b34b2c); ?>
<?php endif; ?>
                </div>
                <p><?php echo e($contactEmail); ?></p>
            </div>
        </div>

        <!-- WhatsApp CTA -->
        <div class="mt-16 text-center">
            <a href="https://wa.me/6281916577540?text=Assalamu'alaikum%2C%20saya%20ingin%20bertanya%20tentang%20PPDB%20PonpesDIBAMA"
               target="_blank"
               class="inline-flex items-center px-8 py-4 bg-green-500 hover:bg-green-600 text-white text-base md:text-lg font-semibold rounded-full shadow-lg transition-all transform hover:scale-105">
                <!-- WhatsApp Inline SVG -->
                <svg class="w-6 h-6 mr-3" viewBox="0 0 32 32" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill="#FFFFFF" d="M16 .5C7.438.5.5 7.438.5 16c0 2.798.73 5.434 2.074 7.735L.5 31.5l7.916-2.057A15.412 15.412 0 0016 31.5c8.562 0 15.5-6.938 15.5-15.5S24.562.5 16 .5zm0 28.375c-2.488 0-4.93-.662-7.074-1.914l-.51-.294-4.688 1.22 1.25-4.6-.324-.523A13.181 13.181 0 012.812 16C2.812 8.895 8.895 2.812 16 2.812S29.188 8.895 29.188 16 23.105 28.875 16 28.875z"/>
                    <path fill="#FFFFFF" d="M23.292 19.69l-2.583-.734a1.074 1.074 0 00-1.034.279l-.845.865a11.072 11.072 0 01-5.154-5.155l.865-.845c.286-.286.385-.703.28-1.034l-.735-2.584a1.074 1.074 0 00-1.005-.748c-.057 0-.115.005-.173.017l-2.72.575a1.074 1.074 0 00-.796.796c-.223.98-.34 2.005-.34 3.064 0 5.662 4.61 10.272 10.272 10.272 1.059 0 2.085-.117 3.064-.34a1.074 1.074 0 00.796-.796l.575-2.72a1.074 1.074 0 00-.748-1.006z"/>
                </svg>
                Hubungi Admin via WhatsApp
            </a>
        </div>

        <!-- Location Map -->
        <div class="mt-20">
            <h3 class="text-2xl md:text-3xl font-bold text-center mb-6">Lokasi Kami</h3>
            <div class="w-full h-80 bg-gray-100 rounded-xl shadow-xl overflow-hidden border-4 border-white">
                <?php if($locationMapUrl): ?>
                    <iframe src="<?php echo e($locationMapUrl); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <?php else: ?>
                    <div class="flex items-center justify-center h-full text-gray-600">
                        <p>Peta Lokasi Akan Ditampilkan Di Sini</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        // === DOM ELEMENTS ===
        const getDailyAdviceBtn = document.getElementById('getDailyAdviceBtn');
        const dailyAdviceOutput = document.getElementById('dailyAdviceOutput');
        const dailyAdviceSpinner = document.getElementById('dailyAdviceSpinner');
        const generateActivityBtn = document.getElementById('generateActivityBtn');
        const activityModal = document.getElementById('activityModal');
        const closeActivityModal = document.getElementById('closeActivityModal');
        const activityIdeaContent = document.getElementById('activityIdeaContent');
        const activityModalSpinner = document.getElementById('activityModalSpinner');

        // === SMOOTH SCROLLING FOR INTERNAL LINKS ===
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();

                const headerHeight = document.querySelector('header')?.offsetHeight || 0;
                const floatingNavHeight = document.querySelector('nav.sticky')?.offsetHeight || 0;
                const offset = headerHeight + floatingNavHeight + 30;

                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);

                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - offset,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // === SCROLLSPY: Highlight Active Navigation Link ===
        const sections = document.querySelectorAll("section[id]");
        const navLinks = document.querySelectorAll(".nav-link");

        function activateLink() {
            const scrollY = window.pageYOffset;

            sections.forEach((section) => {
                const sectionTop = section.offsetTop - 160;
                const sectionHeight = section.offsetHeight;
                const sectionId = section.getAttribute("id");

                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    navLinks.forEach((link) => {
                        link.classList.remove("active");
                        if (link.getAttribute("href") === `#${sectionId}`) {
                            link.classList.add("active");
                        }
                    });
                }
            });
        }

        window.addEventListener("scroll", activateLink);

        // === DAILY ADVICE FEATURE ===
        getDailyAdviceBtn?.addEventListener('click', async () => {
            dailyAdviceOutput.textContent = '';
            dailyAdviceSpinner.classList.remove('hidden');
            getDailyAdviceBtn.disabled = true;

            try {
                const prompt = "Berikan satu nasihat singkat Islami atau kutipan Al-Quran/Hadits beserta terjemahan/maknanya dalam bahasa Indonesia. Batasi hingga 500 karakter.";
                const chatHistory = [{ role: "user", parts: [{ text: prompt }] }];
                const payload = { contents: chatHistory };
                const apiKey = "AIzaSyDxC3Qv2HIKFtg3wVI5Cbr9jVZacVwI7YI";
                const apiUrl = `https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=${apiKey}`;

                const response = await fetch(apiUrl, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(`Error API: ${response.status} - ${errorData.error?.message || 'Unknown error'}`);
                }

                const result = await response.json();
                const text = result?.candidates?.[0]?.content?.parts?.[0]?.text;

                if (text) {
                    dailyAdviceOutput.textContent = text;
                } else {
                    dailyAdviceOutput.textContent = 'Gagal mendapatkan nasihat. Silakan coba lagi.';
                    console.error('Unexpected API response structure:', result);
                }
            } catch (error) {
                console.error('Error generating daily advice:', error);
                dailyAdviceOutput.textContent = 'Terjadi kesalahan saat mengambil nasihat: ' + error.message;
            } finally {
                dailyAdviceSpinner.classList.add('hidden');
                getDailyAdviceBtn.disabled = false;
            }
        });

        // === MODAL HANDLING ===
        closeActivityModal?.addEventListener('click', () => {
            activityModal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === activityModal) {
                activityModal.style.display = 'none';
            }
        });
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('web.apps', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/home.blade.php ENDPATH**/ ?>