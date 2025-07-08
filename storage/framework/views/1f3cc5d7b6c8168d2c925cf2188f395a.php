<?php $__env->startSection('title', 'Tambah Halaqoh Baru'); ?>
<?php $__env->startSection('header_admin', 'Buat Halaqoh Baru'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <form action="<?php echo e(route('admin.halaqohs.store')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>

            <?php echo $__env->make('admin.halaqohs.partials._form_general', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.halaqohs.partials._form_students', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('admin.halaqohs.partials._form_schedules', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="flex items-center justify-end mt-6">
                <a href="<?php echo e(route('admin.halaqohs.index')); ?>" class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-700 rounded-full font-semibold hover:bg-gray-300 shadow-sm mr-2">
                    Batal
                </a>
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-700 text-white rounded-full font-semibold hover:bg-teal-800 shadow-lg">
                    Simpan Halaqoh
                </button>
            </div>
        </form>
    </div>
</div>

<?php echo $__env->make('admin.halaqohs.partials._script', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/halaqohs/create.blade.php ENDPATH**/ ?>