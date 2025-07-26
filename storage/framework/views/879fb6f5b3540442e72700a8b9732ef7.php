<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'route',
    'title',
    'color' => 'teal'
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
    'route',
    'title',
    'color' => 'teal'
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
$button = "bg-{$color}-500 hover:bg-{$color}-600";
?>

<div class="bg-white rounded-2xl shadow-xl p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-2xl border <?php echo e($bg); ?>">
    <div class="<?php echo e($bg); ?> rounded-full p-4 mb-4 <?php echo e($text); ?> shadow-md">
        <?php echo e($icon ?? ''); ?>

    </div>
    <h3 class="text-xl font-bold text-gray-800 mb-2"><?php echo e($title); ?></h3>
    <p class="text-gray-600 mb-4"><?php echo e($slot); ?></p>
    <a href="<?php echo e(route($route)); ?>" class="mt-auto px-5 py-2 <?php echo e($button); ?> text-white rounded-full transition-colors shadow-md">
        Kelola
    </a>
</div>
<?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/components/dashboard/card.blade.php ENDPATH**/ ?>