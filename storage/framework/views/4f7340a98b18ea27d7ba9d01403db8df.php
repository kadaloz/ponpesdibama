<?php use App\Models\Setting; ?>



<?php $__env->startSection('title', 'Pengaturan Website'); ?>
<?php $__env->startSection('header_admin', 'Pengaturan Website'); ?>

<?php $__env->startSection('admin_content'); ?>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-2xl font-bold text-teal-700 mb-6">Kelola Informasi Website</h3>

        <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <form action="<?php echo e(route('admin.settings.update')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div>
                <label for="about_us_content" class="block text-sm font-medium text-gray-700">Konten Tentang Pondok</label>
                <textarea name="about_us_content" id="about_us_content" rows="12" class="ckeditor mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"><?php echo e(old('about_us_content', $settings['about_us_content'] ?? '')); ?></textarea>
                <?php $__errorArgs = ['about_us_content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label for="mission_quote" class="block text-sm font-medium text-gray-700">Kutipan Misi</label>
                <textarea name="mission_quote" id="mission_quote" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"><?php echo e(old('mission_quote', $settings['mission_quote'] ?? '')); ?></textarea>
                <?php $__errorArgs = ['mission_quote'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label for="pondok_photo" class="block text-sm font-medium text-gray-700">Foto Pondok</label>
                <input type="file" name="pondok_photo" id="pondok_photo" class="mt-1 block w-full text-sm text-gray-500 file:rounded-md file:border-0 file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                <?php if($settings['pondok_photo']): ?>
                    <p class="mt-2 text-sm text-gray-600">Foto saat ini:</p>
                    <img src="<?php echo e(asset('storage/' . $settings['pondok_photo'])); ?>" alt="Foto Pondok" class="h-32 w-auto object-cover rounded-md mt-2 shadow-sm">
                <?php endif; ?>
                <?php $__errorArgs = ['pondok_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <h4 class="text-xl font-bold text-gray-800 pt-4 border-t border-gray-200">Informasi Kontak</h4>
            <div>
                <label for="contact_address" class="block text-sm font-medium text-gray-700">Alamat Kontak</label>
                <input type="text" name="contact_address" id="contact_address" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('contact_address', $settings['contact_address'] ?? '')); ?>">
                <?php $__errorArgs = ['contact_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="contact_phone" class="block text-sm font-medium text-gray-700">Nomor Telepon/HP</label>
                <input type="text" name="contact_phone" id="contact_phone" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('contact_phone', $settings['contact_phone'] ?? '')); ?>">
                <?php $__errorArgs = ['contact_phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="contact_email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                <input type="email" name="contact_email" id="contact_email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('contact_email', $settings['contact_email'] ?? '')); ?>">
                <?php $__errorArgs = ['contact_email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            
            <div>
                <label for="location_map_url" class="block text-sm font-medium text-gray-700">URL Peta Lokasi (iframe Google Maps Embed)</label>
                <input type="url" name="location_map_url" id="location_map_url" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('location_map_url', $settings['location_map_url'] ?? '')); ?>" placeholder="https://www.google.com/maps/embed?...">
                <?php $__errorArgs = ['location_map_url'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <?php if($settings['location_map_url']): ?>
                    <div class="mt-2 w-full h-64 border rounded-md overflow-hidden">
                        <iframe src="<?php echo e($settings['location_map_url']); ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                <?php endif; ?>
            </div>

            
            <div class="pt-4 border-t border-gray-200">
                <label for="is_ppdb_open" class="block text-xl font-bold text-gray-800 mb-2">Status Pendaftaran PSB</label>
                <div class="flex items-center space-x-3">
                    <input type="hidden" name="is_ppdb_open" value="0">
                    <input type="checkbox" name="is_ppdb_open" id="is_ppdb_open" value="1" class="h-5 w-5 text-teal-600 border-gray-300 rounded" <?php echo e(old('is_ppdb_open', $settings['is_ppdb_open']) ? 'checked' : ''); ?>>
                    <label for="is_ppdb_open" class="text-lg font-medium text-gray-700">Aktifkan PSB Online</label>
                </div>
            </div>

            
            <div class="pt-4 border-t border-gray-200">
                <label for="ppdb_academic_year" class="block text-xl font-bold text-gray-800 mb-2">Tahun Ajaran PSB</label>
                <input type="text" name="ppdb_academic_year" id="ppdb_academic_year" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('ppdb_academic_year', $settings['ppdb_academic_year'] ?? '')); ?>">
            </div>

            
            <div class="pt-4 border-t border-gray-200">
                <label for="cta_enrollment_heading" class="block text-xl font-bold text-gray-800 mb-2">Teks Heading Pendaftaran Utama</label>
                <input type="text" name="cta_enrollment_heading" id="cta_enrollment_heading" class="mt-1 block w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('cta_enrollment_heading', $settings['cta_enrollment_heading'] ?? '')); ?>">
            </div>

            
            <div class="flex items-center justify-end mt-6">
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-500 text-white font-semibold text-sm uppercase tracking-widest rounded-md hover:bg-teal-600 transition">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
    
    <script src="https://cdn.ckeditor.com/ckeditor5/41.2.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#about_us_content'))
            .catch(error => {
                console.error(error);
            });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/settings/edit.blade.php ENDPATH**/ ?>