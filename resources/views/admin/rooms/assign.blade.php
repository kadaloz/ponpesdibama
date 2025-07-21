@extends('layouts.admin')

@section('title', 'Atur Penghuni Kamar: ' . $room->room_number)
@section('header_admin', 'Atur Penghuni Kamar')

@section('admin_content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-8 text-gray-900">
            <h3 class="text-3xl font-extrabold text-teal-700 mb-8 text-center border-b pb-4">
                Atur Penghuni Kamar: {{ $room->room_number }} (Kapasitas: {{ $room->currentOccupancy() }}/{{ $room->capacity }})
            </h3>

            <form action="{{ route('admin.rooms.assign.students', $room) }}" method="POST">
                @csrf
                @method('POST')

                <div class="mb-6 p-6 bg-blue-50 rounded-lg border border-blue-200"
                    x-data="{ searchTerm: '',
                                students: @json($availableStudents->map(function($student) use ($room) {
                                    return [
                                        'id' => $student->id,
                                        'name' => $student->name,
                                        'nis' => $student->nis,
                                        'current_room_number' => $student->currentRoomPlacement->room->room_number ?? null,
                                        'is_checked' => in_array($student->id, $room->currentStudents->pluck('student_id')->toArray()),
                                        'is_current_room' => ($student->currentRoomPlacement && $student->currentRoomPlacement->room_id == $room->id), // Santri sudah di kamar ini
                                        'is_other_room' => ($student->currentRoomPlacement && $student->currentRoomPlacement->room_id != $room->id) // Santri di kamar lain
                                    ];
                                })),
                                filteredStudents() {
                                    const lowerCaseSearchTerm = this.searchTerm.toLowerCase();
                                    return this.students.filter(student =>
                                        student.name.toLowerCase().includes(lowerCaseSearchTerm) ||
                                        student.nis.toLowerCase().includes(lowerCaseSearchTerm)
                                    );
                                }
                             }"
                >
                    <div class="mb-4">
                        <label for="search_student" class="block text-gray-700 text-lg font-bold mb-2">Cari Santri:</label>
                        <input
                            type="text"
                            id="search_student"
                            x-model.debounce.300ms="searchTerm"
                            placeholder="Cari berdasarkan nama atau NIS..."
                            class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        >
                    </div>

                    <label for="student_ids" class="block text-gray-700 text-lg font-bold mb-4 mt-6">Pilih Santri Penghuni:</label>

                    <div x-show="filteredStudents().length === 0 && searchTerm !== ''" class="text-gray-600 italic mb-4">
                        Tidak ada santri yang cocok dengan pencarian Anda.
                    </div>
                    <div x-show="students.length === 0" class="text-gray-600 italic mb-4">
                        Tidak ada santri yang tersedia untuk dipilih.
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" x-show="filteredStudents().length > 0">
                        <template x-for="student in filteredStudents()" :key="student.id">
                            <div class="flex items-center p-3 border border-gray-300 rounded-lg bg-white shadow-sm"
                                 :class="{ 'border-green-400': student.is_current_room, 'border-orange-400': student.is_other_room }"
                            >
                                <input
                                    type="checkbox"
                                    name="student_ids[]"
                                    :id="`student_${student.id}`"
                                    :value="student.id"
                                    class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500"
                                    x-model="student.is_checked"
                                >
                                <label :for="`student_${student.id}`" class="ml-3 text-gray-800 text-base font-medium flex-grow">
                                    <span x-text="student.name"></span> <span class="text-gray-500 text-sm">(<span x-text="student.nis"></span>)</span>
                                    <template x-if="student.is_other_room">
                                        <br><span class="text-orange-500 text-xs">(Saat ini di kamar: <span x-text="student.current_room_number"></span>)</span>
                                    </template>
                                    <template x-if="student.is_current_room">
                                        <br><span class="text-green-500 text-xs">(Sudah di kamar ini)</span>
                                    </template>
                                </label>
                            </div>
                        </template>
                    </div>

                    @error('student_ids')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-4 mt-8 border-t pt-6">
                    <a href="{{ route('admin.rooms.show', $room) }}" class="inline-flex items-center px-6 py-3 bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <x-heroicon-o-arrow-left class="w-4 h-4 mr-2 -ml-1" />
                        Batal
                    </a>
                    <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-full font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:ring-offset-2 transition ease-in-out duration-150 shadow-md">
                        <x-heroicon-o-check class="w-4 h-4 mr-2 -ml-1" />
                        Simpan Penghuni
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection