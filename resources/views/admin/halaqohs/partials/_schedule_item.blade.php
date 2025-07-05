<div class="schedule-item transition-all duration-300 ease-in-out transform bg-white border border-gray-200 rounded-xl p-5 shadow-sm space-y-4 md:space-y-0 md:grid md:grid-cols-12 md:gap-4">
    {{-- Hari --}}
    <div class="md:col-span-3">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Hari</label>
        <select name="schedules[{{ $index }}][day_of_week]" class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
            <option value="">Pilih Hari</option>
            @foreach ($daysOfWeek as $day)
                <option value="{{ $day }}">{{ $day }}</option>
            @endforeach
        </select>
    </div>

    {{-- Mulai --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Mulai</label>
        <input type="time" name="schedules[{{ $index }}][start_time]"
               class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
    </div>

    {{-- Selesai --}}
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Selesai</label>
        <input type="time" name="schedules[{{ $index }}][end_time]"
               class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
    </div>

    {{-- Lokasi --}}
    <div class="md:col-span-4">
        <label class="block text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
        <input type="text" name="schedules[{{ $index }}][location]" placeholder="Opsional"
               class="block w-full px-4 py-2 text-sm border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
    </div>

    {{-- Tombol Hapus --}}
    <div class="md:col-span-1 flex md:justify-center mt-1 md:mt-0">
    <button type="button" onclick="removeScheduleField(this)"
        class="inline-flex items-center justify-center text-red-600 hover:text-white hover:bg-red-500 border border-red-500 rounded-md px-2.5 py-1.5 text-xs font-medium transition-all duration-200">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M6 18L18 6M6 6l12 12"/>
        </svg>
        Hapus
    </button>
</div>

</div>
