    
    

    <?php $__env->startSection('title', 'Manajemen Umum'); ?>

    <?php $__env->startSection('header_admin', 'Manajemen Umum'); ?>

    <?php $__env->startSection('admin_content'); ?>
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h3 class="text-2xl font-bold text-teal-700 mb-6">Pilih Modul Manajemen Umum</h3>
                <p class="text-gray-700 mb-8">
                    Modul-modul ini mengelola aspek-aspek operasional pondok secara lebih spesifik.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Card: Manajemen Pendaftaran -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-xl border border-yellow-100">
                        <div class="bg-yellow-100 rounded-full p-4 mb-4 text-yellow-600 shadow-sm">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M10 20v-2a2 2 0 012-2h2a2 2 0 012 2v2m-3-2V8a2 2 0 00-2-2"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Manajemen Pendaftaran</h3>
                        <p class="text-gray-600 mb-4">Kelola data calon santri yang mendaftar PSB.</p>
                        <a href="#" class="mt-auto px-5 py-2 bg-yellow-500 text-white rounded-full hover:bg-yellow-600 transition-colors shadow-md">
                            Kelola Pendaftar
                        </a>
                    </div>

                    <!-- Card: Manajemen Keuangan -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-xl border border-orange-100">
                        <div class="bg-orange-100 rounded-full p-4 mb-4 text-orange-600 shadow-sm">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2V21m-3-11V3m-3 0h6a2 2 0 012 2v7a2 2 0 01-2 2h-6a2 2 0 01-2-2V5a2 2 0 012-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Manajemen Keuangan</h3>
                        <p class="text-gray-600 mb-4">Lacak pembayaran, biaya, dan laporan keuangan pondok.</p>
                        <a href="#" class="mt-auto px-5 py-2 bg-orange-500 text-white rounded-full hover:bg-orange-600 transition-colors shadow-md">
                            Kelola Keuangan
                        </a>
                    </div>

                    <!-- Card: Manajemen Pengajar -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-xl border border-red-100">
                        <div class="bg-red-100 rounded-full p-4 mb-4 text-red-600 shadow-sm">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h2a2 2 0 002-2V8a2 2 0 00-2-2h-2V4a2 2 0 00-2-2H9a2 2 0 00-2 2v2H5a2 2 0 00-2 2v10a2 2 0 002 2h2m4-10v5m4-5v5m-9-5V4a2 2 0 012-2h2a2 2 0 012 2v2"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Manajemen Pengajar</h3>
                        <p class="text-gray-600 mb-4">Kelola data pengajar, ustadz/ustadzah, dan karyawan.</p>
                        <a href="#" class="mt-auto px-5 py-2 bg-red-500 text-white rounded-full hover:bg-red-600 transition-colors shadow-md">
                            Kelola Pengajar
                        </a>
                    </div>

                    <!-- Card: Manajemen Asrama -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-xl border border-gray-200">
                        <div class="bg-gray-200 rounded-full p-4 mb-4 text-gray-600 shadow-sm">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5a2 2 0 00-2 2v2a2 2 0 002 2h14a2 2 0 002-2v-2a2 2 0 00-2-2zM10 17H5a2 2 0 00-2 2v2a2 2 0 002 2h5a2 2 0 002-2v-2a2 2 0 00-2-2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Manajemen Asrama</h3>
                        <p class="text-gray-600 mb-4">Kelola data kamar, penempatan, dan inventaris asrama.</p>
                        <a href="#" class="mt-auto px-5 py-2 bg-gray-500 text-white rounded-full hover:bg-gray-600 transition-colors shadow-md">
                            Kelola Asrama
                        </a>
                    </div>

                    <!-- Card: Manajemen Akun Pengguna -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-xl border border-cyan-100">
                        <div class="bg-cyan-100 rounded-full p-4 mb-4 text-cyan-600 shadow-sm">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M10 20v-2a2 2 0 012-2h2a2 2 0 012 2v2m-3-2V8a2 2 0 00-2-2"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Manajemen Akun Pengguna</h3>
                        <p class="text-gray-600 mb-4">Kelola akun admin, sekretaris, mudabbir, dan lainnya.</p>
                        <a href="#" class="mt-auto px-5 py-2 bg-cyan-500 text-white rounded-full hover:bg-cyan-600 transition-colors shadow-md">
                            Kelola Pengguna
                        </a>
                    </div>

                    <!-- Card: Laporan -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-xl border border-fuchsia-100">
                        <div class="bg-fuchsia-100 rounded-full p-4 mb-4 text-fuchsia-600 shadow-sm">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-4a2 2 0 012-2h2a2 2 0 012 2v4m-5 0H9m5 0h2a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v12a2 2 0 002 2h2m2 0a2 2 0 002-2h2a2 2 0 002-2V3a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Laporan & Statistik</h3>
                        <p class="text-gray-600 mb-4">Lihat laporan pendaftaran, keuangan, dan data lainnya.</p>
                        <a href="#" class="mt-auto px-5 py-2 bg-fuchsia-500 text-white rounded-full hover:bg-fuchsia-600 transition-colors shadow-md">
                            Lihat Laporan
                        </a>
                    </div>

                    <!-- Card: Manajemen Event -->
                    <div class="bg-white rounded-lg shadow-md p-6 flex flex-col items-center text-center transition-transform duration-300 hover:scale-105 hover:shadow-xl border border-pink-100">
                        <div class="bg-pink-100 rounded-full p-4 mb-4 text-pink-600 shadow-sm">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Manajemen Event</h3>
                        <p class="text-gray-600 mb-4">Atur jadwal kajian, lomba, liburan, dan acara pondok.</p>
                        <a href="#" class="mt-auto px-5 py-2 bg-pink-500 text-white rounded-full hover:bg-pink-600 transition-colors shadow-md">
                            Kelola Event
                        </a>
                    </div>

                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u448104011/domains/ponpesdibama.com/public_html/resources/views/admin/general/dashboard.blade.php ENDPATH**/ ?>