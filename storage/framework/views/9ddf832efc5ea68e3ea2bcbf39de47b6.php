<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Orang Tua & Alamat</h3>


<div class="mb-4">
    <label for="parent_name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Orang Tua/Wali</label>
    <input type="text" name="parent_name" id="parent_name" required
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: H. Abdul Hakim" value="<?php echo e(old('parent_name')); ?>">
</div>


<div class="mb-4">
    <label for="parent_phone" class="block text-sm font-semibold text-gray-700 mb-1">No. HP Orang Tua/Wali</label>
    <input type="text" name="parent_phone" id="parent_phone" required
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: 081234567890" value="<?php echo e(old('parent_phone')); ?>">
</div>


<div class="mb-4">
    <label for="parent_email" class="block text-sm font-semibold text-gray-700 mb-1">Email Orang Tua/Wali (opsional)</label>
    <input type="email" name="parent_email" id="parent_email"
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: ayah@email.com" value="<?php echo e(old('parent_email')); ?>">
</div>


<div class="mb-4">
    <label for="parent_occupation" class="block text-sm font-semibold text-gray-700 mb-1">Pekerjaan Orang Tua/Wali</label>
    <input type="text" name="parent_occupation" id="parent_occupation"
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: Petani" value="<?php echo e(old('parent_occupation')); ?>">
</div>


<div class="mb-4">
    <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
    <textarea name="address" id="address" rows="3" required
        class="w-full px-4 py-2 border rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        placeholder="Contoh: Jl. Merpati No. 45, Desa Aikmel"><?php echo e(old('address')); ?></textarea>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <div>
        <label for="province" class="block text-sm font-semibold text-gray-700 mb-1">Provinsi</label>
        <select name="province" id="province" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Provinsi</option>
        </select>
        <?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div>
        <label for="city" class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten/Kota</label>
        <select name="city" id="city" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Kabupaten/Kota</option>
        </select>
        <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>

<?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/components/ppdb/step2.blade.php ENDPATH**/ ?>