<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title',
    'color' => 'gray'
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
    'title',
    'color' => 'gray'
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
$bg = "bg-{$color}-100";
$text = "text-{$color}-600";
?>

<div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl border <?php echo e($bg); ?>">
    <div class="<?php echo e($bg); ?> rounded-full p-4 mb-4 <?php echo e($text); ?> shadow-md">
        <?php echo e($icon ?? ''); ?>

    </div>
    <h3 class="text-xl font-bold text-gray-800 mb-4"><?php echo e($title); ?></h3>
    <div class="text-left text-gray-700 w-full mb-4">
        <?php echo e($slot); ?>

    </div>
</div>
<?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/components/dashboard/statistik.blade.php ENDPATH**/ ?>