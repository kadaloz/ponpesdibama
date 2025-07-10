<div class="mb-4 <?php echo e($attributes->get('class')); ?>">
    <label for="<?php echo e($name); ?>" class="block text-sm font-semibold text-gray-700 mb-1">
        <?php echo e($label); ?>

    </label>

    <?php echo e($slot); ?>


    <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
        <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/components/form/group.blade.php ENDPATH**/ ?>