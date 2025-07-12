<?php $__env->startSection('title', 'Manajemen Akun Pengguna'); ?>

<?php $__env->startSection('header_admin', 'Manajemen Akun Pengguna'); ?>

<?php $__env->startSection('admin_content'); ?>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="flex justify-between items-center mb-6">
                <h3 class="text-2xl font-bold text-teal-700">Daftar Pengguna</h3>
                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?> 
                    <a href="<?php echo e(route('admin.users.create')); ?>" class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 focus:bg-teal-600 active:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Tambah Pengguna Baru
                    </a>
                <?php endif; ?>
            </div>

            <?php if(session('success')): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e(session('success')); ?></span>
                </div>
            <?php endif; ?>
            <?php if(session('error')): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline"><?php echo e(session('error')); ?></span>
                </div>
            <?php endif; ?>

            <?php if($allUsers->isEmpty()): ?>
                <p class="text-gray-600 text-center py-4">Belum ada pengguna terdaftar.</p>
            <?php else: ?>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-sm">
                        <thead class="bg-gray-100 border-b border-gray-200">
                            <tr>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Nama</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="py-3 px-6 text-left text-xs font-medium text-gray-600 uppercase tracking-wider">Peran</th>
                                <th class="py-3 px-6 text-center text-xs font-medium text-gray-600 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $__currentLoopData = $allUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="py-4 px-6 text-sm font-medium text-gray-900"><?php echo e($user->name); ?></td>
                                    <td class="py-4 px-6 text-sm text-gray-500"><?php echo e($user->email); ?></td>
                                    <td class="py-4 px-6 text-sm text-gray-500">
                                        <?php $__empty_1 = true; $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <?php echo e($role); ?>

                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Tidak Ada Peran
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="py-4 px-6 text-center text-sm font-medium whitespace-nowrap">
                                        <?php if (\Illuminate\Support\Facades\Blade::check('role', 'admin')): ?> 
                                            <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="inline-flex items-center text-white bg-indigo-500 hover:bg-indigo-600 mx-1 px-3 py-1 rounded-md transition-colors duration-150">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                Edit
                                            </a>
                                            <form action="<?php echo e(route('admin.users.destroy', $user)); ?>" method="POST" class="inline-block ml-1" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="inline-flex items-center text-white bg-red-500 hover:bg-red-600 px-3 py-1 rounded-md transition-colors duration-150">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10H4a1 1 0 01-1-1V5a1 1 0 011-1h16a1 1 0 011 1v1a1 1 0 01-1 1z"></path></svg>
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

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/admin/users/index.blade.php ENDPATH**/ ?>