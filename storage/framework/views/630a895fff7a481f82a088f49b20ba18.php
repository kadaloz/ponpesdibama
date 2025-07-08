<?php $__env->startSection('title', 'Manajemen Data Santri'); ?>
<?php $__env->startSection('header_admin', 'Manajemen Data Santri'); ?>

<?php $__env->startSection('admin_content'); ?>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900">
            <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                <h3 class="text-3xl font-extrabold text-teal-700 mb-4 md:mb-0">Daftar Santri</h3>
                <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-4">
                    <a href="<?php echo e(route('admin.students.create')); ?>" class="inline-flex items-center px-6 py-3 bg-teal-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-400 shadow-lg transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                        Tambah Santri Baru
                    </a>
                    <a href="<?php echo e(route('admin.students.export')); ?>" class="inline-flex items-center px-6 py-3 bg-green-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 shadow-lg transform hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H5a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                        Export Excel
                    </a>
                    <form action="<?php echo e(route('admin.students.import')); ?>" method="POST" enctype="multipart/form-data" class="inline-flex items-center">
                        <?php echo csrf_field(); ?>
                        <label for="import_file" class="inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-full font-semibold text-sm text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 shadow-lg cursor-pointer transform hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" /></svg>
                            Import Excel
                        </label>
                        <input type="file" name="file" id="import_file" class="hidden" onchange="this.form.submit()">
                    </form>
                </div>
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

            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <form action="<?php echo e(route('admin.students.index')); ?>" method="GET" class="flex flex-col gap-2 md:flex-row md:items-center md:gap-4">
                    <input type="text" name="search" value="<?php echo e($search); ?>" placeholder="Cari santri..." class="px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
                    <select name="gender_filter" class="px-7 py-2 border border-gray-300 rounded-md shadow-sm text-sm">
                        <option value="">Jenis Kelamin</option>
                        <option value="Laki-laki" <?php echo e($genderFilter == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo e($genderFilter == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                    </select>
                    <select name="status_filter" class="px-7 py-2 border border-gray-300 rounded-md shadow-sm text-sm">
                        <option value="">Semua Status</option>
                        <option value="aktif" <?php echo e(request('status_filter') == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="non-aktif" <?php echo e(request('status_filter') == 'non-aktif' ? 'selected' : ''); ?>>Non-Aktif</option>
                        <option value="lulus" <?php echo e(request('status_filter') == 'lulus' ? 'selected' : ''); ?>>Lulus</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-md hover:bg-teal-700 shadow-sm text-sm">Filter</button>
                    <?php if($search || $genderFilter || request('status_filter')): ?>
                        <a href="<?php echo e(route('admin.students.index')); ?>" class="px-3 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 shadow-sm text-sm">Reset</a>
                    <?php endif; ?>
                </form>
            </div>

            
            <div class="overflow-x-auto bg-white rounded-lg shadow-xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-700">NIS</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-700">Nama</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-700">Jenis Kelamin</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-700">Status</th>
                            <th class="px-6 py-3 text-center font-medium text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $allStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4"><?php echo e($student->nis ?? '-'); ?></td>
                                <td class="px-6 py-4"><?php echo e($student->name); ?></td>
                                <td class="px-6 py-4"><?php echo e($student->gender ?? '-'); ?></td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo e($student->status == 'aktif' ? 'bg-green-100 text-green-800' :
                                        ($student->status == 'non-aktif' ? 'bg-yellow-100 text-yellow-800' :
                                        ($student->status == 'lulus' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))); ?>">
                                        <?php echo e(ucfirst(str_replace('-', ' ', $student->status))); ?>

                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <a href="<?php echo e(route('admin.students.show', $student)); ?>" class="text-sm px-3 py-1 bg-gray-200 text-gray-800 rounded-full hover:bg-gray-300">Lihat</a>
                                    <a href="<?php echo e(route('admin.students.edit', $student)); ?>" class="text-sm px-3 py-1 bg-indigo-600 text-white rounded-full hover:bg-indigo-700 ml-2">Edit</a>
                                    <form action="<?php echo e(route('admin.students.destroy', $student)); ?>" method="POST" class="inline-block ml-2" onsubmit="return confirm('Apakah Anda yakin ingin menghapus?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-sm px-3 py-1 bg-red-600 text-white rounded-full hover:bg-red-700">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center py-12">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 11c.456 0 .907.05 1.342.144a3.375 3.375 0 11-5.23 2.902 3.376 3.376 0 013.888-3.046zM12 12c1.657 0 3-1.343 3-3S13.657 6 12 6s-3 1.343-3 3 1.343 3 3 3z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 18a8 8 0 0116 0v.25A2.75 2.75 0 0117.25 21H6.75A2.75 2.75 0 014 18.25V18z" />
                                        </svg>
                                        <p class="text-gray-500 italic text-sm">Tidak ada data santri ditemukan.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            
            <div class="mt-6">
                <?php echo e($allStudents->onEachSide(1)->links('vendor.pagination.tailwind')); ?>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/students/index.blade.php ENDPATH**/ ?>