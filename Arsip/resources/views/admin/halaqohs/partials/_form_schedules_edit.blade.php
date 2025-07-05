<section class="mt-10">
    <h3 class="text-2xl font-bold text-teal-700 mb-4">🗓️ Edit Jadwal Halaqoh</h3>

    <p class="text-sm text-gray-600 mb-6">
        Anda dapat memperbarui, menambahkan, atau menghapus jadwal pertemuan untuk halaqoh ini.
    </p>

    {{-- Jadwal yang sudah ada --}}
    <div id="existing-schedules" class="space-y-6">
        @foreach ($halaqoh->schedules as $i => $schedule)
            <div class="schedule-item existing transition-all duration-300 ease-in-out transform bg-white border border-gray-200 rounded-xl p-5 shadow-sm grid grid-cols-12 gap-4 items-end">
                <input type="hidden" name="schedules[{{ $i }}][id]" value="{{ $schedule->id }}">

                {{-- Hari --}}
                <div class="col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
                    <select name="schedules[{{ $i }}][day_of_week]" class="form-select">
                        @foreach ($daysOfWeek as $day)
                            <option value="{{ $day }}" {{ $schedule->day_of_week === $day ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Jam Mulai --}}
                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Mulai</label>
                    <input type="time" name="schedules[{{ $i }}][start_time]" value="{{ $schedule->start_time }}" class="form-input">
                </div>

                {{-- Jam Selesai --}}
                <div class="col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Selesai</label>
                    <input type="time" name="schedules[{{ $i }}][end_time]" value="{{ $schedule->end_time }}" class="form-input">
                </div>

                {{-- Lokasi --}}
                <div class="col-span-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                    <input type="text" name="schedules[{{ $i }}][location]" value="{{ $schedule->location }}" class="form-input" placeholder="Opsional">
                </div>

                {{-- Tombol hapus --}}
                <div class="col-span-1 flex justify-center">
                    <button type="button" onclick="removeScheduleField(this, {{ $schedule->id }})"
                        class="px-2 py-1.5 text-xs text-red-600 hover:text-white hover:bg-red-500 border border-red-500 rounded-md font-medium flex items-center transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg> Hapus
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Jadwal baru (dinamis) --}}
    <div id="new-schedules" class="space-y-6 mt-8">
        {{-- Jadwal baru ditambahkan dengan JS --}}
    </div>

    <div class="mt-6 flex justify-start">
        <button type="button" id="add-schedule-edit"
            class="inline-flex items-center px-5 py-2.5 bg-teal-600 hover:bg-teal-700 text-white rounded-lg text-sm font-semibold transition-all duration-200 shadow-md">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v16m8-8H4" />
            </svg>
            Tambah Jadwal Baru
        </button>
    </div>
</section>
