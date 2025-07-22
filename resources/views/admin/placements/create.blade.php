@extends('layouts.admin')

@section('title', 'Tempatkan Santri ke Kamar')
@section('header_admin', 'Tempatkan Santri ke Kamar Asrama')

@section('admin_content')
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-2xl font-bold text-teal-700 mb-6">Form Penempatan Santri Baru</h3>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.placements.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Santri --}}
                <div>
                    <label for="student_id" class="block text-sm font-medium text-gray-700">Pilih Santri <span class="text-red-500">*</span></label>
                    <select id="student_id" name="student_id">
                        <option value="">Cari dan pilih santri...</option>
                    </select>
                    <span id="students-loading" class="text-sm text-gray-500 hidden">Memuat data santri...</span>
                    @error('student_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kamar --}}
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
                                {{ $room->room_number }} ({{ $room->currentOccupancy() }}/{{ $room->capacity }} - {{ ucfirst($room->gender_type) }})
                            </option>
                        @endforeach
                    </select>
                    @error('room_id')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label for="start_date" class="block text-sm font-medium text-gray-700">Tanggal Mulai <span class="text-red-500">*</span></label>
                    <input type="date" name="start_date" id="start_date"
                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-teal-500 focus:border-teal-500 @error('start_date') border-red-500 @enderror"
                        value="{{ old('start_date', date('Y-m-d')) }}" required>
                    @error('start_date')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Tombol --}}
            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.placements.index') }}" class="px-4 py-2 bg-gray-200 rounded font-semibold text-xs text-gray-700 hover:bg-gray-300">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded font-semibold text-xs hover:bg-teal-700">
                    <x-heroicon-o-check class="w-4 h-4 mr-2" /> Tempatkan Santri
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const loadingText = document.getElementById('students-loading');
    const roomSelect = document.getElementById('room_id');
    let studentsData = [];

    const tomSelect = new TomSelect('#student_id', {
        valueField: 'id',
        labelField: 'name',
        searchField: ['name', 'nis'],
        placeholder: 'Cari dan pilih santri...',
        load: function(query, callback) {
            if (!query.length) return callback();
            loadingText.classList.remove('hidden');

            fetch(`/api/available-students?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    loadingText.classList.add('hidden');
                    studentsData = data.map(s => ({
                        id: s.id,
                        name: `${s.name} (NIS: ${s.nis})`,
                        gender: s.gender
                    }));
                    callback(studentsData);
                })
                .catch(() => callback());
        },
        onChange: function() {
            filterRooms();
        }
    });

    function filterRooms() {
        const selectedValue = tomSelect.getValue();
        const selectedStudent = studentsData.find(s => s.id == selectedValue);
        const studentGender = selectedStudent?.gender?.toLowerCase();

        Array.from(roomSelect.options).forEach(option => {
            option.style.display = '';
            if (option.value === "") return;

            const roomGender = option.dataset.gender?.toLowerCase();
            const roomCapacity = parseInt(option.dataset.capacity);
            const roomOccupancy = parseInt(option.dataset.occupancy);

            if (studentGender && roomGender !== studentGender) {
                option.style.display = 'none';
            } else {
                option.disabled = roomOccupancy >= roomCapacity;
                option.textContent = option.textContent.replace(' (PENUH)', '');
                if (option.disabled) {
                    option.textContent += ' (PENUH)';
                }
            }
        });

        const selectedRoom = roomSelect.selectedOptions[0];
        if (selectedRoom && (selectedRoom.disabled || selectedRoom.style.display === 'none')) {
            roomSelect.value = "";
        }
    }
});
</script>
@endpush
@endsection
