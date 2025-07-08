<?php $__env->startSection('title', 'Detail Data Santri'); ?>

<?php $__env->startSection('header_admin', 'Detail Data Santri'); ?>

<?php $__env->startSection('admin_content'); ?>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900"> 
            <h3 class="text-3xl font-extrabold text-teal-700 mb-8 text-center border-b pb-4">Informasi Lengkap Santri</h3> 

            
            <div class="mb-8 p-6 bg-teal-50 rounded-xl shadow-inner border border-teal-200">
                <h4 class="font-bold text-xl text-teal-700 mb-4">Ringkasan Santri</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-800 text-lg">
                    <div>
                        <p class="font-medium">NIS:</p>
                        <p class="block text-xl font-bold text-teal-800"><?php echo e($student->nis ?? '-'); ?></p>
                    </div>
                    <div>
                        <p class="font-medium">Nama Lengkap:</p>
                        <p class="block"><?php echo e($student->name); ?></p>
                    </div>
                    <div>
                        <p class="font-medium">Kategori:</p>
                        <p class="block"><?php echo e($student->category ?? '-'); ?></p>
                    </div>
                    <div>
                        <p class="font-medium">Tipe Santri:</p>
                        <p class="block"><?php echo e($student->type ?? '-'); ?></p>
                    </div>
                    <?php if($student->type == 'Pulang-Pergi'): ?> 
                        <div>
                            <p class="font-medium">Periode Ngaji:</p>
                            <p class="block"><?php echo e($student->halaqoh_period ?? '-'); ?></p>
                        </div>
                    <?php endif; ?>
                    <div>
                        <p class="font-medium">Status Santri:</p>
                        <p class="block text-xl font-bold px-3 py-1 rounded-full inline-block <?php echo e($student->status == 'aktif' ? 'bg-green-100 text-green-800' :
                            ($student->status == 'non-aktif' ? 'bg-yellow-100 text-yellow-800' :
                            ($student->status == 'lulus' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800'))); ?>">
                            <?php echo e(ucfirst(str_replace('-', ' ', $student->status))); ?>

                        </p>
                    </div>
                </div>
            </div>

            
            <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200 text-center">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2">Foto Santri</h4>
                <?php if($student->photo_path): ?>
                    <img src="<?php echo e(asset('storage/' . $student->photo_path)); ?>" alt="Foto Santri <?php echo e($student->name); ?>" class="mx-auto max-w-xs h-auto object-cover rounded-md shadow-lg border border-gray-300">
                <?php else: ?>
                    <p class="text-gray-600 italic">Tidak ada foto santri.</p>
                <?php endif; ?>
            </div>

            
            <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2">Data Pribadi Santri</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                    <div><span class="font-medium">Jenis Kelamin:</span> <?php echo e($student->gender ?? '-'); ?></div>
                    <div><span class="font-medium">Tempat, Tanggal Lahir:</span> <?php echo e($student->place_of_birth ?? '-'); ?>, <?php echo e($student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d F Y') : '-'); ?></div>
                    <div><span class="font-medium">NISN:</span> <?php echo e($student->nisn ?? '-'); ?></div>
                    <div><span class="font-medium">Pendidikan Terakhir:</span> <?php echo e($student->last_education ?? '-'); ?></div>
                    <div><span class="font-medium">Asal Sekolah:</span> <?php echo e($student->school_origin ?? '-'); ?></div>
                    <div><span class="font-medium">Tahun Masuk:</span> <?php echo e($student->admission_year ?? '-'); ?></div>
                </div>
            </div>

            
            <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2">Data Orang Tua / Wali</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                    <div><span class="font-medium">Nama Ayah / Wali:</span> <?php echo e($student->parent_name ?? '-'); ?></div>
                    <div><span class="font-medium">Nomor HP / WA:</span> <?php echo e($student->parent_phone ?? '-'); ?></div>
                    <div><span class="font-medium">Email:</span> <?php echo e($student->parent_email ?? '-'); ?></div>
                    <div><span class="font-medium">Pekerjaan:</span> <?php echo e($student->parent_occupation ?? '-'); ?></div>
                </div>
            </div>

            
            <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2">Informasi Alamat Santri</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                    <div class="col-span-full"><span class="font-medium">Alamat Lengkap:</span> <?php echo e($student->address ?? '-'); ?></div>
                    <div><span class="font-medium">Kota:</span> <?php echo e($student->city ?? '-'); ?></div>
                    <div><span class="font-medium">Provinsi:</span> <?php echo e($student->province ?? '-'); ?></div>
                </div>
            </div>

            
            <div class="mt-8 p-6 bg-teal-50 rounded-xl shadow-sm border border-teal-200">
                <h4 class="font-semibold text-xl text-teal-800 mb-4 border-b pb-2">Dokumen Santri</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php
                        $documentFields = [
                            'document_akta_path' => 'Akta Kelahiran',
                            'document_kk_path' => 'Kartu Keluarga (KK)',
                            'document_ijazah_path' => 'Ijazah Terakhir',
                            'document_photo_path' => 'Pas Foto Dokumen',
                        ];
                    ?>
                    <?php $__currentLoopData = $documentFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pathColumn => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 border rounded-lg bg-white flex items-center justify-between shadow-sm">
                            <span class="font-medium text-gray-700"><?php echo e($name); ?>:</span>
                            <?php if($student->{$pathColumn}): ?>
                                <a href="<?php echo e(asset('storage/' . $student->{$pathColumn})); ?>" target="_blank" class="text-blue-600 hover:underline flex items-center">
                                    Lihat Dokumen
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0l-10 10M14 4H9"></path></svg>
                                </a>
                            <?php else: ?>
                                <span class="text-gray-500 italic">Tidak ada</span>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            
            <?php if($student->applicant): ?>
                <div class="mt-8 p-6 bg-blue-50 rounded-xl shadow-sm border border-blue-200">
                    <h4 class="font-semibold text-xl text-blue-700 mb-4 border-b pb-2">Asal Data Pendaftar PPDB</h4>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-blue-700 text-base">
                        <div><span class="font-medium">No. Pendaftaran PPDB:</span> <span class="font-bold"><?php echo e($student->applicant->registration_number ?? '-'); ?></span></div>
                        <div><span class="font-medium">Email Orang Tua Pendaftar:</span> <?php echo e($student->applicant->parent_email ?? '-'); ?></div>
                        <div><span class="font-medium">Asal Sekolah Pendaftar:</span> <?php echo e($student->applicant->school_origin ?? '-'); ?></div>
                        <div><span class="font-medium">Status PPDB Terakhir:</span> <?php echo e(ucfirst(str_replace('_', ' ', $student->applicant->status ?? '-'))); ?></div>
                        <div class="col-span-full">
                            <a href="<?php echo e(route('admin.applicants.show', $student->applicant->id)); ?>" class="inline-flex items-center text-sm px-4 py-2 bg-blue-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md mt-4">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.478 0-8.268-2.943-9.542-7z"></path></svg>
                                Lihat Detail Pendaftar
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            
            <div class="mt-10 text-center border-t pt-6 flex justify-end space-x-4">
                <a href="<?php echo e(route('admin.students.index')); ?>" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
                <a href="<?php echo e(route('admin.students.edit', $student)); ?>" class="inline-flex items-center text-sm px-4 py-2 bg-indigo-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit Santri
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/students/show.blade.php ENDPATH**/ ?>