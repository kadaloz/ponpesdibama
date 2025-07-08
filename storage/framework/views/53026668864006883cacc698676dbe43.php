<h3 class="text-2xl font-semibold text-teal-700 mb-6 border-b pb-2 pt-6">Santri dalam Halaqoh</h3>
<p class="text-sm text-gray-600 mb-4">Pilih santri yang akan tergabung dalam halaqoh ini. Anda dapat memilih lebih dari satu.</p>

<div class="mb-6">
    <label for="selected_students" class="block text-sm font-semibold text-gray-700">Pilih Santri</label>
    <select name="selected_students[]" id="selected_students" multiple
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500 h-52">
        <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($student->id); ?>" data-data='{"type": "<?php echo e($student->type ?? 'N/A'); ?>"}'>
                <?php echo e($student->name); ?> (NIS: <?php echo e($student->nis ?? '-'); ?>) - Tipe: <?php echo e($student->type ?? 'N/A'); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['selected_students'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php $__errorArgs = ['selected_students.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/halaqohs/partials/_form_students.blade.php ENDPATH**/ ?>