<?php $__env->startSection('title', 'Manajemen Pengajar'); ?>

<?php $__env->startSection('header_admin', 'Manajemen Data Pengajar'); ?>

<?php $__env->startSection('admin_content'); ?>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <h3 class="text-3xl font-extrabold text-teal-700 mb-4 md:mb-0">Daftar Pengajar</h3>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create teachers')): ?> 
                    <a href="<?php echo e(route('admin.teachers.create')); ?>" class="inline-flex items-center px-6 py-3 bg-teal-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:bg-teal-700 focus:bg-teal-700 active:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Pengajar Baru
                    </a>
                <?php endif; ?>
            </div>

            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-5 py-3 rounded-lg relative mb-6 shadow-sm" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-5 py-3 rounded-lg relative mb-6 shadow-sm" role="alert">
                    <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>

            <?php if($allTeachers->isEmpty()): ?>
                <p class="text-gray-600 text-center py-10 bg-gray-50 rounded-lg border border-gray-200 text-lg">Belum ada data pengajar yang terdaftar.</p>
            <?php else: ?>
                <div class="overflow-x-auto bg-white rounded-lg shadow-xl border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/5">NIP</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/4">Nama Lengkap</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Spesialisasi</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="py-3 px-6 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Akun Pengguna</th>
                                <th class="py-3 px-6 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider w-1/5">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__currentLoopData = $allTeachers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $teacher): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="even:bg-gray-50 hover:bg-gray-100 transition-colors duration-150">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900"><?php echo e($teacher->nip ?? '-'); ?></td>
                                    <td class="py-4 px-6 text-sm text-gray-900"><?php echo e($teacher->full_name); ?></td>
                                    <td class="py-4 px-6 text-sm text-gray-600"><?php echo e($teacher->specialization ?? '-'); ?></td>
                                    <td class="py-4 px-6 text-sm">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($teacher->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'); ?>">
                                            <?php echo e(ucfirst($teacher->status)); ?>

                                        </span>
                                    </td>
                                    <td class="py-4 px-6 text-sm text-gray-600">
                                        <?php if($teacher->user): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <?php echo e($teacher->user->name); ?> (<?php echo e($teacher->user->email); ?>)
                                            </span>
                                        <?php else: ?>
                                            <span class="text-gray-400 italic">Belum terhubung</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-6 text-center text-sm font-medium whitespace-nowrap">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view teachers')): ?> 
                                            <a href="<?php echo e(route('admin.teachers.show', $teacher->id)); ?>" class="inline-flex items-center text-sm px-4 py-2 bg-gray-200 border border-transparent rounded-full font-semibold text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"></path></svg>
                                                Lihat
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit teachers')): ?> 
                                            <a href="<?php echo e(route('admin.teachers.edit', $teacher->id)); ?>" class="inline-flex items-center text-sm px-4 py-2 bg-indigo-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md ml-3">
                                                <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Edit
                                            </a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete teachers')): ?> 
                                            <form action="<?php echo e(route('admin.teachers.destroy', $teacher->id)); ?>" method="POST" class="inline-block ml-3" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pengajar ini? Aksi ini tidak dapat dibatalkan.');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="inline-flex items-center text-sm px-4 py-2 bg-red-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                                                    <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10H4a1 1 0 01-1-1V5a1 1 0 011-1h16a1 1 0 011 1v1a1 1 0 01-1 1z"></path></svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/teachers/index.blade.php ENDPATH**/ ?>