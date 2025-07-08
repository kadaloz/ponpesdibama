<?php $__env->startSection('title', 'Edit Syarat Pendaftaran PPDB'); ?>
<?php $__env->startSection('header_admin', 'Syarat Pendaftaran'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="bg-white p-6 rounded shadow max-w-3xl mx-auto">
    <?php if(session('success')): ?>
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <form method="POST" action="<?php echo e(route('admin.ppdb-requirements.update')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <label for="content" class="block font-semibold text-gray-700 mb-2">Syarat Pendaftaran</label>
        <textarea name="content" id="content" rows="10" class="w-full border-gray-300 rounded shadow-sm"><?php echo e(old('content', $requirement->content ?? '')); ?></textarea>

        <button class="mt-4 px-6 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">Simpan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/ppdb/requirement_edit.blade.php ENDPATH**/ ?>