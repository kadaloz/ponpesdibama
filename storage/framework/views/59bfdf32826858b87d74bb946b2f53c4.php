
<footer class="bg-gradient-to-tr from-teal-800 to-teal-900 text-white py-12 mt-20 rounded-t-3xl shadow-inner">
    <div class="container mx-auto px-6">
        <!-- Grid Layout -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center md:text-left">
            <!-- Brand & Copyright -->
            <div>
                <h4 class="text-2xl font-bold mb-3">Ponpes DIBAMA</h4>
                <p class="text-gray-300 text-sm leading-relaxed">
                    Mendidik Generasi Qur’ani, Berakhlaq Islami, Untuk Membangun Negeri.
                </p>
                <p class="mt-4 text-sm text-gray-400">&copy; <?php echo e(date('Y')); ?>. All rights reserved.</p>
            </div>

            <!-- Menu -->
            <div>
                <h5 class="text-lg font-semibold mb-3">Tautan Penting</h5>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?php echo e(url('/ppdb')); ?>" class="hover:underline text-gray-300 hover:text-white transition">Pendaftaran PPDB</a></li>
                    <li><a href="#" class="hover:underline text-gray-300 hover:text-white transition">Kebijakan Privasi</a></li>
                    <li><a href="#" class="hover:underline text-gray-300 hover:text-white transition">Syarat & Ketentuan</a></li>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h5 class="text-lg font-semibold mb-3">Ikuti Kami</h5>
                <div class="space-y-3">
                    <a href="https://facebook.com/DiniyahBaitulMakmur" target="_blank" class="flex items-center space-x-2 text-gray-300 hover:text-white transition">
                        <?php if (isset($component)) { $__componentOriginal1c905e780cce2dce10f915dce1e1ac5b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1c905e780cce2dce10f915dce1e1ac5b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.facebook','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.facebook'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1c905e780cce2dce10f915dce1e1ac5b)): ?>
<?php $attributes = $__attributesOriginal1c905e780cce2dce10f915dce1e1ac5b; ?>
<?php unset($__attributesOriginal1c905e780cce2dce10f915dce1e1ac5b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1c905e780cce2dce10f915dce1e1ac5b)): ?>
<?php $component = $__componentOriginal1c905e780cce2dce10f915dce1e1ac5b; ?>
<?php unset($__componentOriginal1c905e780cce2dce10f915dce1e1ac5b); ?>
<?php endif; ?>
                        <span class="text-sm">@DiniyahBaitulMakmur</span>
                    </a>
                    <a href="https://instagram.com/DiniyahBaitulMakmur" target="_blank" class="flex items-center space-x-2 text-gray-300 hover:text-white transition">
                        <?php if (isset($component)) { $__componentOriginal1ea42232d0b13214e79b5e861644d3ac = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1ea42232d0b13214e79b5e861644d3ac = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.instagram','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.instagram'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1ea42232d0b13214e79b5e861644d3ac)): ?>
<?php $attributes = $__attributesOriginal1ea42232d0b13214e79b5e861644d3ac; ?>
<?php unset($__attributesOriginal1ea42232d0b13214e79b5e861644d3ac); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1ea42232d0b13214e79b5e861644d3ac)): ?>
<?php $component = $__componentOriginal1ea42232d0b13214e79b5e861644d3ac; ?>
<?php unset($__componentOriginal1ea42232d0b13214e79b5e861644d3ac); ?>
<?php endif; ?>
                        <span class="text-sm">@DiniyahBaitulMakmur</span>
                    </a>
                    <a href="https://youtube.com/@DiniyahBaitulMakmur" target="_blank" class="flex items-center space-x-2 text-gray-300 hover:text-white transition">
                        <?php if (isset($component)) { $__componentOriginal4264b316fb7dd2921d622fbdacbeb877 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4264b316fb7dd2921d622fbdacbeb877 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icons.youtube','data' => ['class' => 'w-5 h-5']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icons.youtube'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-5 h-5']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4264b316fb7dd2921d622fbdacbeb877)): ?>
<?php $attributes = $__attributesOriginal4264b316fb7dd2921d622fbdacbeb877; ?>
<?php unset($__attributesOriginal4264b316fb7dd2921d622fbdacbeb877); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4264b316fb7dd2921d622fbdacbeb877)): ?>
<?php $component = $__componentOriginal4264b316fb7dd2921d622fbdacbeb877; ?>
<?php unset($__componentOriginal4264b316fb7dd2921d622fbdacbeb877); ?>
<?php endif; ?>
                        <span class="text-sm">@DiniyahBaitulMakmur</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-teal-700 mt-10 pt-6 text-center text-xs text-teal-300">
            Dibangun oleh Team IT PonpesDibama untuk pendidikan Islam | Laravel + Tailwind CSS
        </div>
    </div>
</footer>
<?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/web/footer.blade.php ENDPATH**/ ?>