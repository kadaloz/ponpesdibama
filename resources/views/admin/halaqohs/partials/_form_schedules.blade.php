<section class="mt-10">
    <div class="flex items-center justify-between mb-4">
        <h3 class="text-2xl font-bold text-teal-700">🗓️ Jadwal Halaqoh</h3>
    </div>

    <p class="text-sm text-gray-600 mb-6 leading-relaxed">
        Tambahkan jadwal pertemuan untuk halaqoh ini. Anda dapat menambahkan lebih dari satu jadwal untuk setiap hari dan waktu yang berbeda.
    </p>

    <div id="schedules-container" class="space-y-6">
        @include('admin.halaqohs.partials._schedule_item', ['index' => 0])
    </div>

    <div class="mt-6 flex justify-start">
        <button type="button" id="add-schedule-field"
            class="inline-flex items-center px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-lg text-sm font-semibold transition-all duration-200 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            Tambah Jadwal Lain
        </button>
    </div>
</section>
