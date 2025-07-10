<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => null,
    'name',
    'label' => '',
    'accept' => '',
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
    'accept' => '',
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

    <input
        type="file"
        id="<?php echo e($id); ?>"
        name="<?php echo e($name); ?>"
        accept="<?php echo e($accept); ?>"
        <?php echo e($required ? 'required' : ''); ?>

        <?php echo e($attributes->except('class')->merge([
            'class' => 'block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100'
        ])); ?>

    />

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
<?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/components/form/file.blade.php ENDPATH**/ ?>