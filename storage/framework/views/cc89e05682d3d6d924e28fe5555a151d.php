<?php $__env->startSection('title', 'Tambah Album Galeri'); ?>

<?php $__env->startSection('header_admin', 'Buat Album Galeri Baru'); ?>

<?php $__env->startSection('admin_content'); ?>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-2xl font-bold text-teal-700 mb-6">Informasi Album</h3>

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

            <form action="<?php echo e(route('admin.galleries.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>

                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul Album</label>
                    <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('title')); ?>" required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Album (Opsional)</label>
                    <textarea name="description" id="description" rows="4" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500"><?php echo e(old('description')); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="cover_image" class="block text-sm font-medium text-gray-700">Gambar Cover Album (Opsional, Maks. 5MB)</label>
                    <input type="file" name="cover_image" id="cover_image" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                    <?php $__errorArgs = ['cover_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="is_published" class="block text-sm font-medium text-gray-700">Status Publikasi</label>
                    <div class="flex items-center space-x-3 mt-2">
                        <input type="hidden" name="is_published" value="0"> 
                        <input type="checkbox" name="is_published" id="is_published" value="1"
                               class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300 rounded"
                               <?php echo e(old('is_published', true) ? 'checked' : ''); ?>> 
                        <label for="is_published" class="text-sm text-gray-900">Publikasikan Album ini</label>
                    </div>
                    <?php $__errorArgs = ['is_published'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Unggah Gambar untuk Album ini</h3>
                <p class="text-sm text-gray-600 mb-4">Anda dapat mengunggah beberapa gambar sekaligus. Maks. 5MB per gambar.</p>

                <div id="image-upload-container" class="space-y-4">
                    
                    <div class="flex items-end space-x-2 image-upload-item">
                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700">Gambar</label>
                            <input type="file" name="images[0][image]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" accept="image/*">
                            <?php $__errorArgs = ['images.0.image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="flex-grow">
                            <label class="block text-sm font-medium text-gray-700">Keterangan Gambar (Opsional)</label>
                            <input type="text" name="images[0][caption]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-base">
                        </div>
                        <button type="button" onclick="removeImageField(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm font-semibold flex-shrink-0">Hapus</button>
                    </div>
                </div>
                <button type="button" id="add-image-field" class="mt-4 px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600 text-sm font-semibold">Tambah Gambar Lain</button>

                <div class="flex items-center justify-end mt-6">
                    <a href="<?php echo e(route('admin.galleries.index')); ?>" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm mr-2">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-700 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-teal-800 focus:bg-teal-800 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                        Simpan Album
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php $__env->startPush('scripts'); ?>
    <script>
        let imageIndex = 1; // Start from 1 because images[0] is already there

        document.getElementById('add-image-field').addEventListener('click', function() {
            const container = document.getElementById('image-upload-container');
            const newItem = document.createElement('div');
            newItem.className = 'flex items-end space-x-2 image-upload-item';
            newItem.innerHTML = `
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700">Gambar</label>
                    <input type="file" name="images[${imageIndex}][image]" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100" accept="image/*">
                </div>
                <div class="flex-grow">
                    <label class="block text-sm font-medium text-gray-700">Keterangan Gambar (Opsional)</label>
                    <input type="text" name="images[${imageIndex}][caption]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-base">
                </div>
                <button type="button" onclick="removeImageField(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm font-semibold flex-shrink-0">Hapus</button>
            `;
            container.appendChild(newItem);
            imageIndex++;
        });

        function removeImageField(button) {
            button.closest('.image-upload-item').remove();
        }
    </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/galleries/create.blade.php ENDPATH**/ ?>