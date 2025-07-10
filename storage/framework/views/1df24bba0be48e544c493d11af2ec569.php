<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id',
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'inputmode' => null,
    'note' => null,
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
    'id',
    'name',
    'label',
    'type' => 'text',
    'value' => '',
    'placeholder' => '',
    'required' => false,
    'inputmode' => null,
    'note' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="mb-4">
    <label for="<?php echo e($id); ?>" class="block text-sm font-semibold text-gray-700 mb-1">
        <?php echo e($label); ?>

        <?php if($note): ?>
            <span class="text-gray-400 italic"><?php echo e($note); ?></span>
        <?php endif; ?>
    </label>
    <input
        type="<?php echo e($type); ?>"
        name="<?php echo e($name); ?>"
        id="<?php echo e($id); ?>"
        value="<?php echo e($value); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        <?php echo e($required ? 'required' : ''); ?>

        <?php echo e($inputmode ? "inputmode=$inputmode" : ''); ?>

        <?php echo e($attributes->merge([
            'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500'
        ])); ?>

    >
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
<?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/components/form/input.blade.php ENDPATH**/ ?>