<?php $__env->startSection('title', 'Detail Pendaftar PPDB'); ?>

<?php $__env->startSection('header_admin', 'Detail Pendaftar PPDB'); ?>

<?php $__env->startSection('admin_content'); ?>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900"> 
            <h3 class="text-3xl font-extrabold text-teal-700 mb-8 text-center border-b pb-4">Informasi Lengkap Pendaftar</h3> 

            
            <div class="mb-8 p-6 bg-blue-50 rounded-xl shadow-inner border border-blue-200">
                <h4 class="font-bold text-xl text-blue-700 mb-4">Ringkasan Pendaftar</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-800 text-lg">
                    <div><span class="font-medium">No. Pendaftaran:</span> <span class="block text-xl font-bold text-teal-800"><?php echo e($applicant->registration_number); ?></span></div>
                    <div><span class="font-medium">Nama Lengkap:</span> <span class="block"><?php echo e($applicant->full_name); ?></span></div>
                    <div><span class="font-medium">Program Dipilih:</span> <span class="block"><?php echo e($applicant->chosen_program ?? '-'); ?></span></div>
                    <div><span class="font-medium">Tipe Pendaftaran:</span> <span class="block"><?php echo e($applicant->ppdb_type ?? '-'); ?></span></div>
                    <?php if($applicant->ppdb_type == 'Pulang-Pergi'): ?> 
                        <div><span class="font-medium">Periode Ngaji:</span> <span class="block"><?php echo e($applicant->halaqoh_period ?? '-'); ?></span></div>
                    <?php endif; ?>
                    <div>
                        <span class="font-medium">Status Pendaftaran:</span>
                        <span class="block text-xl font-bold px-3 py-1 rounded-full inline-block <?php echo e($applicant->status == 'pending' ? 'bg-yellow-100 text-yellow-800' :
                            ($applicant->status == 'submitted' ? 'bg-blue-100 text-blue-800' :
                            ($applicant->status == 'under_review' ? 'bg-purple-100 text-purple-800' :
                            ($applicant->status == 'verified' ? 'bg-indigo-100 text-indigo-800' :
                            ($applicant->status == 'accepted' ? 'bg-green-100 text-green-800' :
                            ($applicant->status == 're-registered' ? 'bg-teal-100 text-teal-800' :
                            ($applicant->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-gray-100 text-gray-800'))))))); ?>">
                            <?php echo e(ucfirst(str_replace('_', ' ', $applicant->status))); ?>

                        </span>
                    </div>
                </div>
            </div>

            
            <div class="mt-10 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2">Data Calon Santri</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                    <div><span class="font-medium">Jenis Kelamin:</span> <?php echo e($applicant->gender ?? '-'); ?></div>
                    <div><span class="font-medium">Tempat, Tanggal Lahir:</span> <?php echo e($applicant->place_of_birth ?? '-'); ?>, <?php echo e($applicant->date_of_birth ? \Carbon\Carbon::parse($applicant->date_of_birth)->format('d F Y') : '-'); ?></div>
                    <div><span class="font-medium">NISN:</span> <?php echo e($applicant->nisn ?? '-'); ?></div>
                    <div><span class="font-medium">Pendidikan Terakhir:</span> <?php echo e($applicant->last_education ?? '-'); ?></div>
                    <div><span class="font-medium">Asal Sekolah:</span> <?php echo e($applicant->school_origin ?? '-'); ?></div>
                </div>
            </div>

            
            <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2">Data Orang Tua / Wali</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                    <div><span class="font-medium">Nama Ayah / Wali:</span> <?php echo e($applicant->parent_name ?? '-'); ?></div>
                    <div><span class="font-medium">Nomor HP / WA:</span> <?php echo e($applicant->parent_phone ?? '-'); ?></div>
                    <div><span class="font-medium">Email:</span> <?php echo e($applicant->parent_email ?? '-'); ?></div>
                    <div><span class="font-medium">Pekerjaan:</span> <?php echo e($applicant->parent_occupation ?? '-'); ?></div>
                </div>
            </div>

            
            <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2">Informasi Alamat</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-y-3 gap-x-8 text-gray-700 text-base">
                    <div class="col-span-full"><span class="font-medium">Alamat Lengkap:</span> <?php echo e($applicant->address ?? '-'); ?></div>
                    <div><span class="font-medium">Kota:</span> <?php echo e($applicant->city ?? '-'); ?></div>
                    <div><span class="font-medium">Provinsi:</span> <?php echo e($applicant->province ?? '-'); ?></div>
                </div>
            </div>

            
            <div class="mt-8 p-6 bg-teal-50 rounded-xl shadow-sm border border-teal-200">
                <h4 class="font-semibold text-xl text-teal-800 mb-4 border-b pb-2">Dokumen Terunggah</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <?php
                        $documentFields = [
                            'document_akta_path' => 'Akta Kelahiran',
                            'document_kk_path' => 'Kartu Keluarga (KK)',
                            'document_ijazah_path' => 'Ijazah Terakhir',
                            'document_photo_path' => 'Pas Foto',
                        ];
                    ?>
                    <?php $__currentLoopData = $documentFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pathColumn => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="p-4 border rounded-lg bg-white flex items-center justify-between shadow-sm">
                            <span class="font-medium text-gray-700"><?php echo e($name); ?>:</span>
                            <?php if($applicant->{$pathColumn}): ?>
                                <a href="<?php echo e(asset('storage/' . $applicant->{$pathColumn})); ?>" target="_blank" class="text-blue-600 hover:underline flex items-center">
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

            
            <div class="mt-8 p-6 bg-gray-50 rounded-xl shadow-sm border border-gray-200">
                <h4 class="font-semibold text-xl text-gray-800 mb-4 border-b pb-2">Catatan Admin</h4>
                <p class="italic text-gray-600"><?php echo e($applicant->admin_notes ?? 'Belum ada catatan.'); ?></p>
            </div>


            
            <div class="mt-10 text-center border-t pt-6 flex justify-end space-x-4">
                <a href="<?php echo e(route('admin.applicants.index')); ?>" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Daftar
                </a>
                <a href="<?php echo e(route('admin.applicants.edit', $applicant)); ?>" class="inline-flex items-center text-sm px-4 py-2 bg-indigo-600 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                    <svg class="w-4 h-4 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                    Edit Pendaftar
                </a>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/applicants/show.blade.php ENDPATH**/ ?>