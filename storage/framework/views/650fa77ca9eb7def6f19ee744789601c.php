<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Program & Dokumen</h3>

<div>
    <label for="chosen_program" class="block text-sm font-medium text-gray-700">Pilih Program</label>
    <select name="chosen_program" id="chosen_program" class="mt-1 w-full px-4 py-2 border rounded-md">
        <option value="">Pilih Program</option>
        <?php $__currentLoopData = $programs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $program): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($program->name); ?>" <?php echo e(old('chosen_program') == $program->name ? 'selected' : ''); ?>><?php echo e($program->name); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
</div>

<div class="mt-4">
    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Pendaftaran</label>
    <div class="space-x-4">
        <label><input type="radio" name="ppdb_type" value="Asrama" <?php echo e(old('ppdb_type') == 'Asrama' ? 'checked' : ''); ?> onchange="toggleHalaqohPeriod()"> Asrama</label>
        <label><input type="radio" name="ppdb_type" value="Pulang-Pergi" <?php echo e(old('ppdb_type') == 'Pulang-Pergi' ? 'checked' : ''); ?> onchange="toggleHalaqohPeriod()"> Pulang-Pergi</label>
    </div>
</div>

<div class="mt-4 hidden" id="halaqoh-period-group">
    <label for="halaqoh_period" class="block text-sm font-medium text-gray-700">Periode Ngaji</label>
    <select name="halaqoh_period" id="halaqoh_period" class="mt-1 w-full px-4 py-2 border rounded-md">
        <option value="">Pilih Periode</option>
        <option value="Sore" <?php echo e(old('halaqoh_period') == 'Sore' ? 'selected' : ''); ?>>Halaqoh Sore</option>
        <option value="Malam" <?php echo e(old('halaqoh_period') == 'Malam' ? 'selected' : ''); ?>>Halaqoh Malam</option>
    </select>
</div>

<div class="space-y-4 pt-6">
    <?php $__currentLoopData = ['akta' => 'Akta Kelahiran', 'kk' => 'Kartu Keluarga (KK)', 'ijazah' => 'Ijazah Terakhir', 'photo' => 'Pas Foto']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div>
            <label for="document_<?php echo e($key); ?>" class="block text-sm font-medium text-gray-700"><?php echo e($label); ?></label>
            <input type="file" name="document_<?php echo e($key); ?>" id="document_<?php echo e($key); ?>" accept=".pdf,.jpg,.jpeg,.png" class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border-0 file:rounded-md file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/components/ppdb/step3.blade.php ENDPATH**/ ?>