<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Calon Santri</h3>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <?php if (isset($component)) { $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96 = $attributes; } ?>
<?php $component = App\View\Components\Form\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'full_name','name' => 'full_name','label' => 'Nama Lengkap','placeholder' => 'Contoh: Ahmad Fulan','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->full_name ?? ''),'required' => true,'autofocus' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $attributes = $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $component = $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'gender','name' => 'gender','label' => 'Jenis Kelamin','options' => ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'],'selected' => $applicant->gender ?? '','placeholder' => 'Pilih Jenis Kelamin','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'gender','name' => 'gender','label' => 'Jenis Kelamin','options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan']),'selected' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->gender ?? ''),'placeholder' => 'Pilih Jenis Kelamin','required' => true]); ?>
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

    
    <?php if (isset($component)) { $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96 = $attributes; } ?>
<?php $component = App\View\Components\Form\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'place_of_birth','name' => 'place_of_birth','label' => 'Tempat Lahir','placeholder' => 'Contoh: Mataram','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->place_of_birth ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $attributes = $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $component = $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96 = $attributes; } ?>
<?php $component = App\View\Components\Form\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'date_of_birth','name' => 'date_of_birth','label' => 'Tanggal Lahir','placeholder' => 'Pilih tanggal lahir','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->date_of_birth ?? ''),'class' => 'flatpickr']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $attributes = $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $component = $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96 = $attributes; } ?>
<?php $component = App\View\Components\Form\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'nisn','name' => 'nisn','label' => 'NISN','placeholder' => '10 digit NISN','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->nisn ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $attributes = $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $component = $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96 = $attributes; } ?>
<?php $component = App\View\Components\Form\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'last_education','name' => 'last_education','label' => 'Pendidikan Terakhir','placeholder' => 'Contoh: SD/MI/SMP','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->last_education ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $attributes = $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $component = $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>

    
    <?php if (isset($component)) { $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96 = $attributes; } ?>
<?php $component = App\View\Components\Form\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'school_origin','name' => 'school_origin','label' => 'Asal Sekolah','placeholder' => 'Contoh: SDN 1 Aikmel','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->school_origin ?? ''),'class' => 'md:col-span-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $attributes = $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96)): ?>
<?php $component = $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96; ?>
<?php unset($__componentOriginalc1d2405c7f8100d77292f2d0299ccd96); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/components/ppdb/step1.blade.php ENDPATH**/ ?>