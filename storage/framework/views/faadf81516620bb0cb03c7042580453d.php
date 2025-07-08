<h3 class="text-2xl font-semibold text-teal-700 mb-6 border-b pb-2">Informasi Halaqoh</h3>


<div class="mb-5">
    <label for="name" class="block text-sm font-semibold text-gray-700">Nama Halaqoh <span class="text-red-500">*</span></label>
    <input type="text" name="name" id="name" placeholder="Contoh: Halaqoh Tahfidz Pagi"
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        value="<?php echo e(old('name')); ?>" required>
    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-5">
    <label for="description" class="block text-sm font-semibold text-gray-700">Deskripsi (Opsional)</label>
    <textarea name="description" id="description" rows="3" placeholder="Tulis deskripsi singkat..."
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"><?php echo e(old('description')); ?></textarea>
    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-5">
    <label for="teacher_id" class="block text-sm font-semibold text-gray-700">Pengajar Utama</label>
    <select name="teacher_id" id="teacher_id"
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">-- Pilih Pengajar --</option>
        <?php $__currentLoopData = $teachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($teacher->id); ?>" <?php echo e(old('teacher_id') == $teacher->id ? 'selected' : ''); ?>>
                <?php echo e($teacher->full_name); ?> (<?php echo e($teacher->specialization ?? 'Umum'); ?>)
            </option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <?php $__errorArgs = ['teacher_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-5">
    <div>
        <label for="start_date" class="block text-sm font-semibold text-gray-700">Tanggal Mulai</label>
        <input type="date" name="start_date" id="start_date"
            class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            value="<?php echo e(old('start_date')); ?>">
        <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
        <label for="end_date" class="block text-sm font-semibold text-gray-700">Tanggal Selesai</label>
        <input type="date" name="end_date" id="end_date"
            class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
            value="<?php echo e(old('end_date')); ?>">
        <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>


<div class="mb-5">
    <label for="status" class="block text-sm font-semibold text-gray-700">Status Halaqoh</label>
    <select name="status" id="status"
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
        <option value="active" <?php echo e(old('status') == 'active' ? 'selected' : ''); ?>>Aktif</option>
        <option value="inactive" <?php echo e(old('status') == 'inactive' ? 'selected' : ''); ?>>Tidak Aktif</option>
        <option value="completed" <?php echo e(old('status') == 'completed' ? 'selected' : ''); ?>>Selesai</option>
    </select>
    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="mb-5">
    <label for="student_limit" class="block text-sm font-semibold text-gray-700">Batas Jumlah Santri</label>
    <input type="number" name="student_limit" id="student_limit"
        class="mt-1 block w-full px-4 py-2 text-sm border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
        value="<?php echo e(old('student_limit', 0)); ?>" min="0">
    <p class="text-gray-500 text-xs mt-1">Masukkan 0 untuk tanpa batas.</p>
    <?php $__errorArgs = ['student_limit'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/halaqohs/partials/_form_general.blade.php ENDPATH**/ ?>