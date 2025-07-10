<?php $__env->startSection('title', 'Tambah Santri Baru'); ?>

<?php $__env->startSection('header_admin', 'Tambah Santri Baru'); ?>

<?php $__env->startSection('admin_content'); ?>
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="<?php echo e(route('admin.students.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <?php echo csrf_field(); ?>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Santri</h3>
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('name')); ?>" required>
                    <?php $__errorArgs = ['name'];
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
                    <label for="nis" class="block text-sm font-medium text-gray-700">Nomor Induk Santri (NIS) (Opsional, akan dibuat otomatis)</label>
                    <input type="text" name="nis" id="nis" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('nis')); ?>">
                    <?php $__errorArgs = ['nis'];
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
                    <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                    <select name="gender" id="gender" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-laki" <?php echo e(old('gender') == 'Laki-laki' ? 'selected' : ''); ?>>Laki-laki</option>
                        <option value="Perempuan" <?php echo e(old('gender') == 'Perempuan' ? 'selected' : ''); ?>>Perempuan</option>
                    </select>
                    <?php $__errorArgs = ['gender'];
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="place_of_birth" class="block text-sm font-medium text-gray-700">Tempat Lahir</label>
                        <input type="text" name="place_of_birth" id="place_of_birth" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('place_of_birth')); ?>">
                        <?php $__errorArgs = ['place_of_birth'];
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
                        <label for="date_of_birth" class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('date_of_birth')); ?>">
                        <?php $__errorArgs = ['date_of_birth'];
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
                </div>

                <div>
                    <label for="nisn" class="block text-sm font-medium text-gray-700">NISN (Nomor Induk Siswa Nasional) (Opsional)</label>
                    <input type="text" name="nisn" id="nisn" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('nisn')); ?>">
                    <?php $__errorArgs = ['nisn'];
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="last_education" class="block text-sm font-medium text-gray-700">Pendidikan Terakhir (Opsional)</label>
                        <input type="text" name="last_education" id="last_education" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('last_education')); ?>">
                        <?php $__errorArgs = ['last_education'];
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
                        <label for="school_origin" class="block text-sm font-medium text-gray-700">Asal Sekolah (Opsional)</label>
                        <input type="text" name="school_origin" id="school_origin" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('school_origin')); ?>">
                        <?php $__errorArgs = ['school_origin'];
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
                </div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Data Orang Tua / Wali</h3>
                <div>
                    <label for="parent_name" class="block text-sm font-medium text-gray-700">Nama Ayah / Wali (Opsional)</label>
                    <input type="text" name="parent_name" id="parent_name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('parent_name')); ?>">
                    <?php $__errorArgs = ['parent_name'];
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
                    <label for="parent_phone" class="block text-sm font-medium text-gray-700">Nomor HP / WhatsApp Orang Tua / Wali (Opsional)</label>
                    <input type="text" name="parent_phone" id="parent_phone" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('parent_phone')); ?>">
                    <?php $__errorArgs = ['parent_phone'];
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
                    <label for="parent_email" class="block text-sm font-medium text-gray-700">Email Orang Tua / Wali (Opsional)</label>
                    <input type="email" name="parent_email" id="parent_email" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('parent_email')); ?>">
                    <?php $__errorArgs = ['parent_email'];
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
                    <label for="parent_occupation" class="block text-sm font-medium text-gray-700">Pekerjaan Orang Tua / Wali (Opsional)</label>
                    <input type="text" name="parent_occupation" id="parent_occupation" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('parent_occupation')); ?>">
                    <?php $__errorArgs = ['parent_occupation'];
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

<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Informasi Alamat Santri</h3>


<div class="mb-4">
    <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
    <textarea name="address" id="address" rows="3"
        class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm"
        placeholder="Contoh: Jl. Merpati No. 45, Desa Aikmel"><?php echo e(old('address')); ?></textarea>
    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>


<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    
    <div>
        <label for="province" class="block text-sm font-semibold text-gray-700 mb-1">Provinsi (Opsional)</label>
        <select name="province" id="province"
            class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
            <option value="">Pilih Provinsi</option>
        </select>
        <?php $__errorArgs = ['province'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div>
        <label for="city" class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten/Kota (Opsional)</label>
        <select name="city" id="city"
            class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
            <option value="">Pilih Kabupaten/Kota</option>
        </select>
        <?php $__errorArgs = ['city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div>
        <label for="district" class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan (Opsional)</label>
        <select name="district" id="district"
            class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
            <option value="">Pilih Kecamatan</option>
        </select>
        <?php $__errorArgs = ['district'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>

    
    <div>
        <label for="village" class="block text-sm font-semibold text-gray-700 mb-1">Kelurahan/Desa (Opsional)</label>
        <select name="village" id="village"
            class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 text-sm">
            <option value="">Pilih Kelurahan/Desa</option>
        </select>
        <?php $__errorArgs = ['village'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>



                
                <div class="pt-4 border-t border-gray-200">
                    <label for="photo" class="block text-sm font-medium text-gray-700">Foto Santri (Opsional, Maks. 2MB)</label>
                    <input type="file" name="photo" id="photo" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100" accept="image/*">
                    <?php $__errorArgs = ['photo'];
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
                
                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Data Akademik & Status Santri</h3>
                <div>
                    <label for="admission_year" class="block text-sm font-medium text-gray-700">Tahun Masuk</label>
                    <input type="number" name="admission_year" id="admission_year" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="<?php echo e(old('admission_year', date('Y'))); ?>">
                    <?php $__errorArgs = ['admission_year'];
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
                    <label for="category" class="block text-sm font-medium text-gray-700">Kategori Santri</label>
                    <select name="category" id="category" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Kategori</option>
                        <option value="Tahfidz" <?php echo e(old('category') == 'Tahfidz' ? 'selected' : ''); ?>>Tahfidz</option>
                        <option value="Kitab Kuning" <?php echo e(old('category') == 'Kitab Kuning' ? 'selected' : ''); ?>>Kitab Kuning</option>
                        <option value="Umum" <?php echo e(old('category') == 'Umum' ? 'selected' : ''); ?>>Umum</option>
                    </select>
                    <?php $__errorArgs = ['category'];
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
                    <label for="type" class="block text-sm font-medium text-gray-700">Tipe Santri</label>
                    <select name="type" id="type" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Tipe</option>
                        <option value="Asrama" <?php echo e(old('type') == 'Asrama' ? 'selected' : ''); ?>>Asrama</option>
                        <option value="Pulang-Pergi" <?php echo e(old('type') == 'Pulang-Pergi' ? 'selected' : ''); ?>>Pulang-Pergi</option>
                    </select>
                    <?php $__errorArgs = ['type'];
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
                    <label for="status" class="block text-sm font-medium text-gray-700">Status Santri</label>
                    <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="aktif" <?php echo e(old('status') == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="non-aktif" <?php echo e(old('status') == 'non-aktif' ? 'selected' : ''); ?>>Non-Aktif</option>
                        <option value="lulus" <?php echo e(old('status') == 'lulus' ? 'selected' : ''); ?>>Lulus</option>
                    </select>
                    <?php $__errorArgs = ['status'];
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

                <div class="flex items-center justify-end mt-4">
                    <a href="<?php echo e(route('admin.students.index')); ?>" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 mr-2">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-600 focus:bg-teal-600 active:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        Simpan Santri
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const provinsiSelect = document.getElementById('province');
    const kabupatenSelect = document.getElementById('city');
    const kecamatanSelect = document.getElementById('district');
    const kelurahanSelect = document.getElementById('village');

    const selectedProv = "<?php echo e(old('province')); ?>";
    const selectedKab = "<?php echo e(old('city')); ?>";
    const selectedKec = "<?php echo e(old('district')); ?>";
    const selectedKel = "<?php echo e(old('village')); ?>";

    fetch('/api/provinces')
        .then(res => res.json())
        .then(provinces => {
            provinces.forEach(prov => {
                const option = new Option(prov, prov, false, prov === selectedProv);
                provinsiSelect.appendChild(option);
            });
            if (selectedProv) updateCities(selectedProv);
        })
        .catch(() => alert('❌ Gagal memuat data provinsi.'));

    provinsiSelect.addEventListener('change', function () {
        updateCities(this.value);
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    });

    kabupatenSelect.addEventListener('change', function () {
        updateDistricts(provinsiSelect.value, this.value);
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    });

    kecamatanSelect.addEventListener('change', function () {
        updateVillages(provinsiSelect.value, kabupatenSelect.value, this.value);
    });

    function updateCities(provinsi) {
        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
        fetch(`/api/cities?province=${encodeURIComponent(provinsi)}`)
            .then(res => res.json())
            .then(cities => {
                cities.forEach(kab => {
                    const option = new Option(kab, kab, false, kab === selectedKab);
                    kabupatenSelect.appendChild(option);
                });
                if (selectedKab) updateDistricts(provinsi, selectedKab);
            })
            .catch(() => alert('❌ Gagal memuat data kota/kabupaten.'));
    }

    function updateDistricts(provinsi, kota) {
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        fetch(`/api/districts?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}`)
            .then(res => res.json())
            .then(districts => {
                districts.forEach(kec => {
                    const option = new Option(kec, kec, false, kec === selectedKec);
                    kecamatanSelect.appendChild(option);
                });
                if (selectedKec) updateVillages(provinsi, kota, selectedKec);
            })
            .catch(() => alert('❌ Gagal memuat data kecamatan.'));
    }

    function updateVillages(provinsi, kota, kecamatan) {
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
        fetch(`/api/villages?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}&district=${encodeURIComponent(kecamatan)}`)
            .then(res => res.json())
            .then(villages => {
                villages.forEach(kel => {
                    const option = new Option(kel, kel, false, kel === selectedKel);
                    kelurahanSelect.appendChild(option);
                });
            })
            .catch(() => alert('❌ Gagal memuat data kelurahan.'));
    }
});
</script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/husnulfuadifebriansyah/Documents/dari git/ponpesdibama/resources/views/admin/students/create.blade.php ENDPATH**/ ?>