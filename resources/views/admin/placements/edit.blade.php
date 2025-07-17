@extends('layouts.admin')

@section('title', 'Kelola Penempatan Santri')
@section('header_admin', 'Kelola Penempatan Santri: ' . $student->name)

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h3 class="text-2xl font-bold text-teal-700 mb-6">Kelola Penempatan Santri</h3>
            <p class="mb-4 text-gray-700">Santri: <span class="font-semibold">{{ $student->name }}</span> saat ini di Kamar: <span class="font-semibold">{{ $placement->room->room_number }}</span></p>

            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ route('admin.placements.update', $placement) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6 p-4 border rounded-lg bg-blue-50 border-blue-200">
                    <h4 class="text-lg font-semibold text-blue-700 mb-3">Pindah Kamar</h4>
                    <div class="mb-4">
                        <label for="new_room_id" class="block text-sm font-medium text-gray-700">Pilih Kamar Baru <span class="text-red-500">*</span></label>
                        <select name="new_room_id" id="new_room_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-blue-500 focus:border-blue-500 @error('new_room_id') border-red-500 @enderror">
                            <option value="">-- Pilih Kamar Baru --</option>
                            @foreach ($availableRooms as $room)
                                @if ($room->id !== $placement->room->id) {{-- Jangan tampilkan kamar yang sedang ditempati --}}
                                <option value="{{ $room->id }}"
                                    data-gender="{{ $room->gender_type }}"
                                    data-capacity="{{ $room->capacity }}"
                                    data-occupancy="{{ $room->currentOccupancy() }}"
                                    {{ old('new_room_id') == $room->id ? 'selected' : '' }}>
                                    {{ $room->room_number }} (Kapasitas: {{ $room->currentOccupancy() }}/{{ $room->capacity }} - {{ ucfirst($room->gender_type) }})
                                </option>
                                @endif
                            @endforeach
                        </select>
                        @error('new_room_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" name="action" value="move_room" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-heroicon-o-arrow-right-circle class="w-4 h-4 mr-2" /> Pindahkan Santri
                    </button>
                </div>

                <div class="mb-6 p-4 border rounded-lg bg-red-50 border-red-200 mt-6">
                    <h4 class="text-lg font-semibold text-red-700 mb-3">Akhiri Penempatan</h4>
                    <p class="text-sm text-gray-600 mb-3">Gunakan opsi ini jika santri keluar dari asrama atau tidak lagi menempati kamar ini.</p>
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Tanggal Keluar <span class="text-red-500">*</span></label>
                        <input type="date" name="end_date" id="end_date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-red-500 focus:border-red-500 @error('end_date') border-red-500 @enderror" value="{{ old('end_date', date('Y-m-d')) }}">
                        @error('end_date')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" name="action" value="end_placement" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <x-heroicon-o-x-circle class="w-4 h-4 mr-2" /> Akhiri Penempatan
                    </button>
                </div>

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admin.placements.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const studentGender = "{{ $student->gender }}";
            const newRoomSelect = document.getElementById('new_room_id');

            function filterRoomsForMove() {
                Array.from(newRoomSelect.options).forEach(option => {
                    option.style.display = ''; // Show all
                    if (option.value === "") return; // Skip "Pilih Kamar" option

                    const roomGender = option.dataset.gender;
                    const roomCapacity = parseInt(option.dataset.capacity);
                    const roomOccupancy = parseInt(option.dataset.occupancy);

                    // Filter by gender
                    if (roomGender !== studentGender) {
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
                if (newRoomSelect.selectedOptions.length > 0 && (newRoomSelect.selectedOptions[0].style.display === 'none' || newRoomSelect.selectedOptions[0].disabled)) {
                    newRoomSelect.value = ""; // Deselect
                }
            }

            filterRoomsForMove(); // Initial filter when page loads
        });
    </script>
    @endpush
@endsection