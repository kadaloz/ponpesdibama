<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">
    Data Orang Tua & Alamat
</h3>


<?php if (isset($component)) { $__componentOriginalc1d2405c7f8100d77292f2d0299ccd96 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc1d2405c7f8100d77292f2d0299ccd96 = $attributes; } ?>
<?php $component = App\View\Components\Form\Input::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Input::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'parent_name','name' => 'parent_name','label' => 'Nama Orang Tua/Wali','placeholder' => 'Contoh: H. Abdul Hakim','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->parent_name ?? ''),'required' => true]); ?>
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
<?php $component->withAttributes(['id' => 'parent_phone','name' => 'parent_phone','label' => 'No. HP Orang Tua/Wali','placeholder' => 'Contoh: 081234567890','type' => 'tel','inputmode' => 'numeric','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->parent_phone ?? ''),'required' => true]); ?>
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
<?php $component->withAttributes(['id' => 'parent_email','name' => 'parent_email','label' => 'Email Orang Tua/Wali','placeholder' => 'Contoh: ayah@email.com','type' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->parent_email ?? ''),'note' => '(opsional)']); ?>
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
<?php $component->withAttributes(['id' => 'parent_occupation','name' => 'parent_occupation','label' => 'Pekerjaan Orang Tua/Wali','placeholder' => 'Contoh: Petani','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->parent_occupation ?? '')]); ?>
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


<?php if (isset($component)) { $__componentOriginal0719bdd33bbc8df585d82deca27b43a6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0719bdd33bbc8df585d82deca27b43a6 = $attributes; } ?>
<?php $component = App\View\Components\Form\Textarea::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.textarea'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Form\Textarea::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'address','name' => 'address','label' => 'Alamat Lengkap','placeholder' => 'Contoh: Jl. Merpati No. 45, Desa Aikmel','rows' => '3','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->address ?? ''),'required' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0719bdd33bbc8df585d82deca27b43a6)): ?>
<?php $attributes = $__attributesOriginal0719bdd33bbc8df585d82deca27b43a6; ?>
<?php unset($__attributesOriginal0719bdd33bbc8df585d82deca27b43a6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0719bdd33bbc8df585d82deca27b43a6)): ?>
<?php $component = $__componentOriginal0719bdd33bbc8df585d82deca27b43a6; ?>
<?php unset($__componentOriginal0719bdd33bbc8df585d82deca27b43a6); ?>
<?php endif; ?>


<?php if (isset($component)) { $__componentOriginala2048da253c890612c2a636d95441591 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala2048da253c890612c2a636d95441591 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.wilayah','data' => ['province' => $applicant->province ?? '','city' => $applicant->city ?? '','district' => $applicant->district ?? '','village' => $applicant->village ?? '']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.wilayah'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['province' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->province ?? ''),'city' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->city ?? ''),'district' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->district ?? ''),'village' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($applicant->village ?? '')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala2048da253c890612c2a636d95441591)): ?>
<?php $attributes = $__attributesOriginala2048da253c890612c2a636d95441591; ?>
<?php unset($__attributesOriginala2048da253c890612c2a636d95441591); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala2048da253c890612c2a636d95441591)): ?>
<?php $component = $__componentOriginala2048da253c890612c2a636d95441591; ?>
<?php unset($__componentOriginala2048da253c890612c2a636d95441591); ?>
<?php endif; ?>
<?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/components/ppdb/step2.blade.php ENDPATH**/ ?>