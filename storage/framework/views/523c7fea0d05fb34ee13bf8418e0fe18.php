<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => null,
    'name',
    'label' => '',
    'options' => [],
    'selected' => '',
    'placeholder' => '',
    'required' => false,
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'id' => null,
    'name',
    'label' => '',
    'options' => [],
    'selected' => '',
    'placeholder' => '',
    'required' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $id = $id ?? $name;
?>

<div class="mb-4 <?php echo e($attributes->get('class')); ?>">
    <?php if($label): ?>
        <label for="<?php echo e($id); ?>" class="block text-sm font-semibold text-gray-700 mb-1">
            <?php echo e($label); ?>

        </label>
    <?php endif; ?>

    <select
        id="<?php echo e($id); ?>"
        name="<?php echo e($name); ?>"
        <?php echo e($required ? 'required' : ''); ?>

        <?php echo e($attributes->except('class')->merge([
            'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500'
        ])); ?>

    >
        <?php if($placeholder): ?>
            <option value=""><?php echo e($placeholder); ?></option>
        <?php endif; ?>

        <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionText): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($optionValue); ?>" <?php echo e($optionValue == $selected ? 'selected' : ''); ?>>
                <?php echo e($optionText); ?>

            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>

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
<?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/components/form/select.blade.php ENDPATH**/ ?>