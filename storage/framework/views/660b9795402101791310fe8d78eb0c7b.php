<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Calon Santri</h3>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    
    <div>
        <label for="full_name" class="block text-sm font-semibold text-gray-700 mb-1">Nama Lengkap</label>
        <input type="text" name="full_name" id="full_name" required autofocus
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Contoh: Ahmad Fulan" value="<?php echo e(old('full_name')); ?>">
        <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div>
        <label for="gender" class="block text-sm font-semibold text-gray-700 mb-1">Jenis Kelamin</label>
        <select name="gender" id="gender" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Jenis Kelamin</option>
            <option value="Laki-laki" <?php echo e(old('gender') == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
            <option value="Perempuan" <?php echo e(old('gender') == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
        </select>
        <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div>
        <label for="place_of_birth" class="block text-sm font-semibold text-gray-700 mb-1">Tempat Lahir</label>
        <input type="text" name="place_of_birth" id="place_of_birth"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Contoh: Mataram" value="<?php echo e(old('place_of_birth')); ?>">
    </div>

    
    <div>
        <label for="date_of_birth" class="block text-sm font-semibold text-gray-700 mb-1">Tanggal Lahir</label>
        <input type="text" name="date_of_birth" id="date_of_birth"
            class="flatpickr w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Pilih tanggal lahir" value="<?php echo e(old('date_of_birth')); ?>">
    </div>


    
    <div>
        <label for="nisn" class="block text-sm font-semibold text-gray-700 mb-1">NISN</label>
        <input type="text" name="nisn" id="nisn"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="10 digit NISN" value="<?php echo e(old('nisn')); ?>">
    </div>

    
    <div>
        <label for="last_education" class="block text-sm font-semibold text-gray-700 mb-1">Pendidikan Terakhir</label>
        <input type="text" name="last_education" id="last_education"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Contoh: SD/MI/SMP" value="<?php echo e(old('last_education')); ?>">
    </div>

    
    <div class="md:col-span-2">
        <label for="school_origin" class="block text-sm font-semibold text-gray-700 mb-1">Asal Sekolah</label>
        <input type="text" name="school_origin" id="school_origin"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            placeholder="Contoh: SDN 1 Aikmel" value="<?php echo e(old('school_origin')); ?>">
    </div>
</div>
<?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/components/ppdb/step1.blade.php ENDPATH**/ ?>