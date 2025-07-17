@extends('layouts.admin')

@section('title', 'Tempatkan Santri ke Kamar')
@section('header_admin', 'Tempatkan Santri ke Kamar Asrama')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-2xl font-bold text-teal-700 mb-6">Form Penempatan Santri Baru</h3>

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.placements.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="student_id" class="block text-sm font-medium text-gray-700">Pilih Santri <span class="text-red-500">*</span></label>
                        <select name="student_id" id="student_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 @error('student_id') border-red-500 @enderror" required>
                            <option value="">-- Pilih Santri --</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}" {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                    {{ $student->name }} (NIS: {{ $student->nis }}) - Jenis Kelamin: {{ ucfirst($student->gender) }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        @if ($students->isEmpty())
                            <p class="mt-2 text-sm text-gray-500">Tidak ada santri yang belum ditempatkan.</p>
                        @endif
                    </div>

                    <div>
                        <label for="room_id" class="block text-sm font-medium text-gray-700">Pilih Kamar <span class="text-red-500">*</span></label>
                        <select name="room_id" id="room_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 @error('room_id') border-red-500 @enderror" required>
                            <option value="">-- Pilih Kamar --</option>
                            @foreach ($availableRooms as $room)
                                <option value="{{ $room->id }}"
                                    {{ old('room_id') == $room->id ? 'selected' : '' }}
                                    data-gender="{{ $room->gender_type }}"
                                    data-capacity="{{ $room->capacity }}"
                                    data-occupancy="{{ $room->currentOccupancy() }}"
                                    >
                                    {{ $room->room_number }} (Kapasitas: {{ $room->currentOccupancy() }}/{{ $room->capacity }} - {{ ucfirst($room->gender_type) }})
                                </option>
                            @endforeach
                        </select>
                        @error('room_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai Menempati <span class="text-red-500">*</span></label>
                        <input type="date" name="start_date" id="start_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 @error('start_date') border-red-500 @enderror" value="{{ old('start_date', date('Y-m-d')) }}" required>
                        @error('start_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-3">
                    <a href="{{ route('admin.placements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-heroicon-o-check class="w-4 h-4 mr-2" /> Tempatkan Santri
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const studentSelect = document.getElementById('student_id');
            const roomSelect = document.getElementById('room_id');

            function filterRooms() {
                const selectedStudentOption = studentSelect.options[studentSelect.selectedIndex];
                const studentGender = selectedStudentOption ? selectedStudentOption.textContent.match(/Jenis Kelamin: (\w+)/)?.[1] : null;

                // Reset room options first
                Array.from(roomSelect.options).forEach(option => {
                    option.style.display = ''; // Show all
                    if (option.value === "") return; // Skip "Pilih Kamar" option

                    const roomGender = option.dataset.gender;
                    const roomCapacity = parseInt(option.dataset.capacity);
                    const roomOccupancy = parseInt(option.dataset.occupancy);

                    // Filter by gender
                    if (studentGender && roomGender !== studentGender.toLowerCase()) {
                        option.style.display = 'none';
                    } else {
                        // Mark if full
                        if (roomOccupancy >= roomCapacity) {
                            option.disabled = true;
                            option.textContent = option.textContent + ' (PENUH)';
                        } else {
                            option.disabled = false;
                            option.textContent = option.textContent.replace(' (PENUH)', ''); // Remove if was marked full
                        }
                    }
                });

                // Re-select if previously selected room is now hidden/disabled
                if (roomSelect.selectedOptions.length > 0 && roomSelect.selectedOptions[0].style.display === 'none' || roomSelect.selectedOptions[0].disabled) {
                    roomSelect.value = ""; // Deselect
                }
            }

            studentSelect.addEventListener('change', filterRooms);

            // Initial filter when page loads if an old value is present
            filterRooms();
        });
    </script>
    @endpush
@endsection