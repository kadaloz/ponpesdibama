<?php $__env->startSection('title', 'Dashboard'); ?>
<?php $__env->startSection('header_admin', 'Dashboard Ponpes DIBAMA'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="bg-white shadow sm:rounded-lg">
    <div class="p-8 text-gray-900">
        <h1 class="text-3xl font-bold text-teal-700 mb-6">Selamat Datang, <?php echo e(Auth::user()?->name); ?>!</h1>
        <p class="text-gray-600 text-base mb-8">
            Silakan pilih modul untuk mengelola berbagai aspek penting website Ponpes DIBAMA.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view news')): ?>
                <?php if (isset($component)) { $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.card','data' => ['route' => 'admin.news.index','title' => 'Berita & Pengumuman','color' => 'teal']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'admin.news.index','title' => 'Berita & Pengumuman','color' => 'teal']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-newspaper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    Kelola berita, pengumuman, dan artikel terbaru pondok.
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $attributes = $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $component = $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view applicants')): ?>
                <?php if (isset($component)) { $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.card','data' => ['route' => 'admin.applicants.index','title' => 'Manajemen Pendaftaran','color' => 'yellow']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'admin.applicants.index','title' => 'Manajemen Pendaftaran','color' => 'yellow']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-user-plus'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    Kelola data calon santri PSB.
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $attributes = $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $component = $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view students')): ?>
                <?php if (isset($component)) { $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.card','data' => ['route' => 'admin.students.index','title' => 'Data Santri','color' => 'blue']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'admin.students.index','title' => 'Data Santri','color' => 'blue']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-identification'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    Kelola data lengkap santri aktif dan alumni.
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $attributes = $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $component = $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage settings')): ?>
                <?php if (isset($component)) { $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.card','data' => ['route' => 'admin.settings.edit','title' => 'Pengaturan Website','color' => 'purple']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'admin.settings.edit','title' => 'Pengaturan Website','color' => 'purple']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-cog-6-tooth'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    Kelola konten statis, informasi kontak, dan lainnya.
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $attributes = $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $component = $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view programs')): ?>
                <?php if (isset($component)) { $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.card','data' => ['route' => 'admin.programs.index','title' => 'Manajemen Program','color' => 'lime']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'admin.programs.index','title' => 'Manajemen Program','color' => 'lime']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-check-circle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    Kelola daftar program pendidikan Ponpes.
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $attributes = $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $component = $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['view students', 'view reports'])): ?>
                <?php if (isset($component)) { $__componentOriginalb00f91d3bb124207b6a9cbc659819e82 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb00f91d3bb124207b6a9cbc659819e82 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.statistik','data' => ['title' => 'Statistik Santri','color' => 'green']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.statistik'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Statistik Santri','color' => 'green']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-chart-pie'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    <p class="text-sm font-semibold">Total: <span class="text-teal-700"><?php echo e($totalStudents ?? 0); ?></span></p>
                    <p class="text-sm font-semibold">Aktif: <span class="text-green-700"><?php echo e($totalActiveStudents ?? 0); ?></span></p>
                    <p class="text-sm font-semibold">Lulus: <span class="text-blue-700"><?php echo e($totalGraduatedStudents ?? 0); ?></span></p>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb00f91d3bb124207b6a9cbc659819e82)): ?>
<?php $attributes = $__attributesOriginalb00f91d3bb124207b6a9cbc659819e82; ?>
<?php unset($__attributesOriginalb00f91d3bb124207b6a9cbc659819e82); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb00f91d3bb124207b6a9cbc659819e82)): ?>
<?php $component = $__componentOriginalb00f91d3bb124207b6a9cbc659819e82; ?>
<?php unset($__componentOriginalb00f91d3bb124207b6a9cbc659819e82); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view general management')): ?>
                <?php if (isset($component)) { $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.card','data' => ['route' => 'admin.general.dashboard','title' => 'Manajemen Umum','color' => 'indigo']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['route' => 'admin.general.dashboard','title' => 'Manajemen Umum','color' => 'indigo']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-home'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    Akses pendaftaran, keuangan, pengajar, asrama, laporan, dan event.
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $attributes = $__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__attributesOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2)): ?>
<?php $component = $__componentOriginalb63f174754b9376d0cbcfda0c77a69e2; ?>
<?php unset($__componentOriginalb63f174754b9376d0cbcfda0c77a69e2); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view news')): ?>
                <?php if (isset($component)) { $__componentOriginalb00f91d3bb124207b6a9cbc659819e82 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb00f91d3bb124207b6a9cbc659819e82 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.statistik','data' => ['title' => 'Statistik Berita','color' => 'orange']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.statistik'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Statistik Berita','color' => 'orange']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-document-text'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    <p class="text-sm font-semibold">Total Berita: <span class="text-teal-700"><?php echo e($totalNews ?? 0); ?></span></p>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb00f91d3bb124207b6a9cbc659819e82)): ?>
<?php $attributes = $__attributesOriginalb00f91d3bb124207b6a9cbc659819e82; ?>
<?php unset($__attributesOriginalb00f91d3bb124207b6a9cbc659819e82); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb00f91d3bb124207b6a9cbc659819e82)): ?>
<?php $component = $__componentOriginalb00f91d3bb124207b6a9cbc659819e82; ?>
<?php unset($__componentOriginalb00f91d3bb124207b6a9cbc659819e82); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view applicants')): ?>
                <?php if (isset($component)) { $__componentOriginalb00f91d3bb124207b6a9cbc659819e82 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb00f91d3bb124207b6a9cbc659819e82 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.statistik','data' => ['title' => 'Statistik Pendaftaran','color' => 'yellow']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.statistik'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Statistik Pendaftaran','color' => 'yellow']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-clipboard-document'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    <p class="text-sm font-semibold">Total: <span class="text-teal-700"><?php echo e($totalApplicants ?? 0); ?></span></p>
                    <p class="text-sm font-semibold">Menunggu: <span class="text-orange-700"><?php echo e($pendingApplicants ?? 0); ?></span></p>
                    <p class="text-sm font-semibold">Diterima: <span class="text-green-700"><?php echo e($acceptedApplicants ?? 0); ?></span></p>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb00f91d3bb124207b6a9cbc659819e82)): ?>
<?php $attributes = $__attributesOriginalb00f91d3bb124207b6a9cbc659819e82; ?>
<?php unset($__attributesOriginalb00f91d3bb124207b6a9cbc659819e82); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb00f91d3bb124207b6a9cbc659819e82)): ?>
<?php $component = $__componentOriginalb00f91d3bb124207b6a9cbc659819e82; ?>
<?php unset($__componentOriginalb00f91d3bb124207b6a9cbc659819e82); ?>
<?php endif; ?>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage users')): ?>
                <?php if (isset($component)) { $__componentOriginalb00f91d3bb124207b6a9cbc659819e82 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb00f91d3bb124207b6a9cbc659819e82 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.dashboard.statistik','data' => ['title' => 'Pengguna Aktif','color' => 'cyan']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dashboard.statistik'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Pengguna Aktif','color' => 'cyan']); ?>
                     <?php $__env->slot('icon', null, []); ?> 
                        <?php if (isset($component)) { $__componentOriginal643fe1b47aec0b76658e1a0200b34b2c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal643fe1b47aec0b76658e1a0200b34b2c = $attributes; } ?>
<?php $component = BladeUI\Icons\Components\Svg::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('heroicon-o-users'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\BladeUI\Icons\Components\Svg::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-12 h-12']); ?>
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
                     <?php $__env->endSlot(); ?>
                    <p class="text-sm font-semibold">Total: <span class="text-teal-700"><?php echo e(App\Models\User::count()); ?></span></p>
                    <p class="text-sm font-semibold">Admin: <span class="text-green-700"><?php echo e(App\Models\User::role('admin')->count()); ?></span></p>
                    <p class="text-sm font-semibold">Sekretaris: <span class="text-blue-700"><?php echo e(App\Models\User::role('sekret')->count()); ?></span></p>
                    <p class="text-sm font-semibold">Mudabbir: <span class="text-purple-700"><?php echo e(App\Models\User::role('mudabbir')->count()); ?></span></p>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb00f91d3bb124207b6a9cbc659819e82)): ?>
<?php $attributes = $__attributesOriginalb00f91d3bb124207b6a9cbc659819e82; ?>
<?php unset($__attributesOriginalb00f91d3bb124207b6a9cbc659819e82); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb00f91d3bb124207b6a9cbc659819e82)): ?>
<?php $component = $__componentOriginalb00f91d3bb124207b6a9cbc659819e82; ?>
<?php unset($__componentOriginalb00f91d3bb124207b6a9cbc659819e82); ?>
<?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>