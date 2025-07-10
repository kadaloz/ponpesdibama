<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'province' => '',
    'city' => '',
    'district' => '',
    'village' => '',
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
    'province' => '',
    'city' => '',
    'district' => '',
    'village' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    <div>
        <label for="province" class="block text-sm font-semibold text-gray-700 mb-1">Provinsi</label>
        <select
            id="province"
            name="province"
            required
            data-selected="<?php echo e($province); ?>"
            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        >
            <option value="">⏳ Memuat Provinsi...</option>
        </select>
        <?php $__errorArgs = ['province'];
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

    <div>
        <label for="city" class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten/Kota</label>
        <select
            id="city"
            name="city"
            required
            data-selected="<?php echo e($city); ?>"
            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        >
            <option value="">Pilih Kabupaten/Kota</option>
        </select>
        <?php $__errorArgs = ['city'];
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

    <div>
        <label for="district" class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan</label>
        <select
            id="district"
            name="district"
            required
            data-selected="<?php echo e($district); ?>"
            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        >
            <option value="">Pilih Kecamatan</option>
        </select>
        <?php $__errorArgs = ['district'];
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

    <div>
        <label for="village" class="block text-sm font-semibold text-gray-700 mb-1">Kelurahan/Desa</label>
        <select
            id="village"
            name="village"
            required
            data-selected="<?php echo e($village); ?>"
            class="w-full border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        >
            <option value="">Pilih Kelurahan/Desa</option>
        </select>
        <?php $__errorArgs = ['village'];
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
</div>
<?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/components/form/wilayah.blade.php ENDPATH**/ ?>