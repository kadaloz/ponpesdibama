{{-- resources/views/admin/halaqohs/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Halaqoh: ' . $halaqoh->name)

@section('header_admin', 'Edit Halaqoh')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <form action="{{ route('admin.halaqohs.update', $halaqoh->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Informasi Halaqoh</h3>

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Halaqoh</label>
                    <input type="text" name="name" id="name" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('name', $halaqoh->name) }}" required>
                    @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                    <textarea name="description" id="description" rows="3" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">{{ old('description', $halaqoh->description) }}</textarea>
                    @error('description')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="teacher_id" class="block text-sm font-medium text-gray-700">Pengajar Utama</label>
                    <select name="teacher_id" id="teacher_id" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Pengajar</option>
                        @foreach ($teachers as $teacher)
                            <option value="{{ $teacher->id }}" {{ old('teacher_id', $halaqoh->teacher_id) == $teacher->id ? 'selected' : '' }}>{{ $teacher->full_name }} ({{ $teacher->specialization ?? 'Umum' }})</option>
                        @endforeach
                    </select>
                    @error('teacher_id')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai (Opsional)</label>
                        <input type="date" name="start_date" id="start_date" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('start_date', $halaqoh->start_date?->format('Y-m-d')) }}">
                        @error('start_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Selesai (Opsional)</label>
                        <input type="date" name="end_date" id="end_date" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('end_date', $halaqoh->end_date?->format('Y-m-d')) }}">
                        @error('end_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status Halaqoh</label>
                    <select name="status" id="status" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" required>
                        <option value="active" {{ old('status', $halaqoh->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status', $halaqoh->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        <option value="completed" {{ old('status', $halaqoh->status) == 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="student_limit" class="block text-sm font-medium text-gray-700">Batas Jumlah Santri (0 untuk tanpa batas)</label>
                    <input type="number" name="student_limit" id="student_limit" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('student_limit', $halaqoh->student_limit) }}" min="0">
                    @error('student_limit')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Santri dalam Halaqoh</h3>
                <p class="text-sm text-gray-600 mb-4">Pilih santri yang akan tergabung dalam halaqoh ini. Santri yang sudah ada akan tetap terpilih.</p>
                
                {{-- Fitur Pencarian Santri (dengan Tom Select) --}}
                <div>
                    <label for="selected_students" class="block text-sm font-medium text-gray-700">Pilih Santri</label>
                    <select name="selected_students[]" id="selected_students" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500 h-48" multiple>
                        @foreach ($students as $student)
                            <option value="{{ $student->id }}" data-data='{"type": "{{ $student->type ?? 'N/A' }}"}' {{ (is_array(old('selected_students', $currentStudents)) && in_array($student->id, old('selected_students', $currentStudents))) ? 'selected' : '' }}>{{ $student->name }} (NIS: {{ $student->nis ?? '-' }}) - Tipe: {{ $student->type ?? 'N/A' }}</option>
                        @endforeach
                    </select>
                    @error('selected_students')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    @error('selected_students.*')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                </div>

                <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Jadwal Halaqoh</h3>
                <p class="text-sm text-gray-600 mb-4">Kelola jadwal pertemuan untuk halaqoh ini.</p>
                <div id="schedules-container" class="space-y-4">
                    @foreach ($halaqoh->schedules->sortBy('day_of_week') as $index => $schedule)
                        <div class="flex flex-col md:flex-row items-end space-y-2 md:space-y-0 md:space-x-2 schedule-item existing-schedule-item" id="schedule-{{ $schedule->id }}">
                            <input type="hidden" name="schedules[{{ $index }}][id]" value="{{ $schedule->id }}">
                            <div class="w-full md:w-1/4">
                                <label class="block text-sm font-medium text-gray-700">Hari</label>
                                <select name="schedules[{{ $index }}][day_of_week]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                                    <option value="">Pilih Hari</option>
                                    @foreach ($daysOfWeek as $day)
                                        <option value="{{ $day }}" {{ old('schedules.' . $index . '.day_of_week', $schedule->day_of_week) == $day ? 'selected' : '' }}>{{ $day }}</option>
                                    @endforeach
                                </select>
                                @error('schedules.' . $index . '.day_of_week')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="w-full md:w-1/4">
                                <label class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                <input type="time" name="schedules[{{ $index }}][start_time]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('schedules.' . $index . '.start_time', $schedule->start_time?->format('H:i')) }}">
                                @error('schedules.' . $index . '.start_time')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="w-full md:w-1/4">
                                <label class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                                <input type="time" name="schedules[{{ $index }}][end_time]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('schedules.' . $index . '.end_time', $schedule->end_time?->format('H:i')) }}">
                                @error('schedules.' . $index . '.end_time')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div class="w-full md:w-1/4">
                                <label class="block text-sm font-medium text-gray-700">Lokasi (Opsional)</label>
                                <input type="text" name="schedules[{{ $index }}][location]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500" value="{{ old('schedules.' . $index . '.location', $schedule->location) }}">
                                @error('schedules.' . $index . '.location')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                            </div>
                            <button type="button" onclick="removeScheduleField(this, {{ $schedule->id }})" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm font-semibold flex-shrink-0">Hapus</button>
                        </div>
                    @endforeach
                    {{-- Template untuk jadwal baru (akan ditambahkan via JS) --}}
                </div>
                <button type="button" id="add-schedule-field" class="mt-4 px-4 py-2 bg-teal-500 text-white rounded-md hover:bg-teal-600 text-sm font-semibold">Tambah Jadwal Lain</button>

                <div class="flex items-center justify-end mt-6">
                    <a href="{{ route('admin.halaqohs.index') }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm mr-2">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-teal-700 border border-transparent rounded-full font-semibold text-white uppercase tracking-widest hover:bg-teal-800 focus:bg-teal-800 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-lg">
                        Simpan Perubahan Halaqoh
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    {{-- Tom Select CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
    {{-- Tom Select JS --}}
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        let scheduleIndex = {{ $halaqoh->schedules->count() > 0 ? $halaqoh->schedules->count() : 0 }}; // Mulai indeks dari jumlah jadwal yang sudah ada

        document.getElementById('add-schedule-field').addEventListener('click', function() {
            const container = document.getElementById('schedules-container');
            const newItem = document.createElement('div');
            newItem.className = 'flex flex-col md:flex-row items-end space-y-2 md:space-y-0 md:space-x-2 schedule-item new-schedule-item';
            newItem.innerHTML = `
                <div class="w-full md:w-1/4">
                    <label class="block text-sm font-medium text-gray-700">Hari</label>
                    <select name="schedules[${scheduleIndex}][day_of_week]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                        <option value="">Pilih Hari</option>
                        @foreach ($daysOfWeek as $day)
                            <option value="{{ $day }}">{{ $day }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="w-full md:w-1/4">
                    <label class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                    <input type="time" name="schedules[${scheduleIndex}][start_time]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                </div>
                <div class="w-full md:w-1/4">
                    <label class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                    <input type="time" name="schedules[${scheduleIndex}][end_time]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                </div>
                <div class="w-full md:w-1/4">
                    <label class="block text-sm font-medium text-gray-700">Lokasi (Opsional)</label>
                    <input type="text" name="schedules[${scheduleIndex}][location]" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
                </div>
                <button type="button" onclick="removeScheduleField(this)" class="px-3 py-2 bg-red-500 text-white rounded-md hover:bg-red-600 text-sm font-semibold flex-shrink-0">Hapus</button>
            `;
            container.appendChild(newItem);
            scheduleIndex++;
        });

        function removeScheduleField(button, scheduleId = null) {
            if (scheduleId) {
                if (confirm('Menghapus jadwal yang sudah ada akan menghapusnya secara permanen dari database. Lanjutkan?')) {
                    fetch(`/admin/halaqohs/schedules/${scheduleId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.message) {
                            alert(data.message);
                            button.closest('.schedule-item').remove();
                        } else {
                            alert('Gagal menghapus jadwal.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus jadwal.');
                    });
                }
            } else {
                button.closest('.schedule-item').remove();
            }
        }

        // Inisialisasi Tom Select pada dropdown santri
        document.addEventListener('DOMContentLoaded', function() {
            const studentLimit = parseInt(document.getElementById('student_limit').value); // Ambil batas santri
            new TomSelect("#selected_students",{
                plugins: ['remove_button'], // Tambahkan plugin untuk tombol hapus pada item yang dipilih
                persist: false,
                create: false, // Jangan izinkan membuat opsi baru
                sortField: {
                    field: "text",
                    direction: "asc"
                },
                placeholder: 'Cari dan pilih santri...',
                maxItems: studentLimit > 0 ? studentLimit : null, // Terapkan batas santri
                // Kustomisasi render untuk menampilkan tipe santri
                itemRenderer: function(data, escape) {
                    return '<div>' + escape(data.text) + ' <span class="text-gray-400 text-xs">(' + escape(data.data.type) + ')</span></div>';
                },
                optionRenderer: function(data, escape) {
                    return '<div>' + escape(data.text) + ' <span class="text-gray-400 text-xs">(' + escape(data.data.type) + ')</span></div>';
                },
            });
        });
    </script>
    @endpush
@endsection
