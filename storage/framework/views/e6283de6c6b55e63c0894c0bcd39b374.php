<div x-data="ppdbForm()" x-init="$nextTick(() => ppdbType = '')" id="ppdbForm">
    <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Program & Dokumen</h3>

    
    <?php if (isset($component)) { $__componentOriginal115fead9001cb250833bb983c7be3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal115fead9001cb250833bb983c7be3f11 = $attributes; } ?>
<?php $component = App\View\Components\Form\Group::resolve(['name' => 'chosen_program','label' => 'Pilih Program'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Group::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'chosen_program','name' => 'chosen_program','options' => $programs->pluck('name')->toArray(),'placeholder' => 'Pilih Program','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'chosen_program','name' => 'chosen_program','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($programs->pluck('name')->toArray()),'placeholder' => 'Pilih Program','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal115fead9001cb250833bb983c7be3f11)): ?>
<?php $attributes = $__attributesOriginal115fead9001cb250833bb983c7be3f11; ?>
<?php unset($__attributesOriginal115fead9001cb250833bb983c7be3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal115fead9001cb250833bb983c7be3f11)): ?>
<?php $component = $__componentOriginal115fead9001cb250833bb983c7be3f11; ?>
<?php unset($__componentOriginal115fead9001cb250833bb983c7be3f11); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginal115fead9001cb250833bb983c7be3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal115fead9001cb250833bb983c7be3f11 = $attributes; } ?>
<?php $component = App\View\Components\Form\Group::resolve(['name' => 'ppdb_type','label' => 'Tipe Pendaftaran'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Group::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
        <div class="flex flex-col gap-4 sm:flex-row sm:gap-6">
            <?php $__currentLoopData = \App\Enums\PpdbType::cases(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $disabled = ($type->value === 'Asrama' && empty($settings['ppdb_asrama_open']))
                             || ($type->value === 'Pulang-Pergi' && empty($settings['ppdb_pulang_pergi_open']));
                ?>
                <label class="inline-flex items-center space-x-2">
                    <input
                        type="radio"
                        name="ppdb_type"
                        value="<?php echo e($type->value); ?>"
                        x-model="ppdbType"
                        class="text-teal-600 focus:ring-teal-500"
                        <?php if($disabled): echo 'disabled'; endif; ?>
                        required
                    >
                    <span><?php echo e($type->label()); ?></span>
                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal115fead9001cb250833bb983c7be3f11)): ?>
<?php $attributes = $__attributesOriginal115fead9001cb250833bb983c7be3f11; ?>
<?php unset($__attributesOriginal115fead9001cb250833bb983c7be3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal115fead9001cb250833bb983c7be3f11)): ?>
<?php $component = $__componentOriginal115fead9001cb250833bb983c7be3f11; ?>
<?php unset($__componentOriginal115fead9001cb250833bb983c7be3f11); ?>
<?php endif; ?>

    
    <template x-if="ppdbType === 'Pulang-Pergi'">
        <?php if (isset($component)) { $__componentOriginal115fead9001cb250833bb983c7be3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal115fead9001cb250833bb983c7be3f11 = $attributes; } ?>
<?php $component = App\View\Components\Form\Group::resolve(['name' => 'halaqoh_period','label' => 'Periode Halaqoh'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Group::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['x-transition:enter' => 'transition ease-out duration-300','x-transition:leave' => 'transition ease-in duration-200']); ?>
            <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'halaqoh_period','name' => 'halaqoh_period','options' => collect(\App\Enums\HalaqohPeriod::cases())->mapWithKeys(fn($p) => [$p->value => $p->label()])->toArray(),'placeholder' => 'Pilih Periode','xBind:required' => 'ppdbType === \'Pulang-Pergi\'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'halaqoh_period','name' => 'halaqoh_period','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(collect(\App\Enums\HalaqohPeriod::cases())->mapWithKeys(fn($p) => [$p->value => $p->label()])->toArray()),'placeholder' => 'Pilih Periode','x-bind:required' => 'ppdbType === \'Pulang-Pergi\'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal115fead9001cb250833bb983c7be3f11)): ?>
<?php $attributes = $__attributesOriginal115fead9001cb250833bb983c7be3f11; ?>
<?php unset($__attributesOriginal115fead9001cb250833bb983c7be3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal115fead9001cb250833bb983c7be3f11)): ?>
<?php $component = $__componentOriginal115fead9001cb250833bb983c7be3f11; ?>
<?php unset($__componentOriginal115fead9001cb250833bb983c7be3f11); ?>
<?php endif; ?>
    </template>

    
    <div class="space-y-4 pt-6">
        <?php $__currentLoopData = [
            'akta' => 'Akta Kelahiran',
            'kk' => 'Kartu Keluarga (KK)',
            'ijazah' => 'Ijazah Terakhir',
            'photo' => 'Pas Foto'
        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal115fead9001cb250833bb983c7be3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal115fead9001cb250833bb983c7be3f11 = $attributes; } ?>
<?php $component = App\View\Components\Form\Group::resolve(['name' => 'document_'.e($key).'','label' => ''.e($label).''] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.group'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Group::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
                <?php if (isset($component)) { $__componentOriginalc991e6deb327f0254c95051bd36ee5bd = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc991e6deb327f0254c95051bd36ee5bd = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.file','data' => ['id' => 'document_'.e($key).'','name' => 'document_'.e($key).'','accept' => '.pdf,.jpg,.jpeg,.png','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.file'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'document_'.e($key).'','name' => 'document_'.e($key).'','accept' => '.pdf,.jpg,.jpeg,.png','required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc991e6deb327f0254c95051bd36ee5bd)): ?>
<?php $attributes = $__attributesOriginalc991e6deb327f0254c95051bd36ee5bd; ?>
<?php unset($__attributesOriginalc991e6deb327f0254c95051bd36ee5bd); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc991e6deb327f0254c95051bd36ee5bd)): ?>
<?php $component = $__componentOriginalc991e6deb327f0254c95051bd36ee5bd; ?>
<?php unset($__componentOriginalc991e6deb327f0254c95051bd36ee5bd); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal115fead9001cb250833bb983c7be3f11)): ?>
<?php $attributes = $__attributesOriginal115fead9001cb250833bb983c7be3f11; ?>
<?php unset($__attributesOriginal115fead9001cb250833bb983c7be3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal115fead9001cb250833bb983c7be3f11)): ?>
<?php $component = $__componentOriginal115fead9001cb250833bb983c7be3f11; ?>
<?php unset($__componentOriginal115fead9001cb250833bb983c7be3f11); ?>
<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/components/ppdb/step3.blade.php ENDPATH**/ ?>