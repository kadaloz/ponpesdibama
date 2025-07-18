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
                @method('POST') {{-- Meskipun method POST di form, Laravel bisa meniru PUT/PATCH jika diperlukan --}}

                <div class="mb-6 p-6 bg-blue-50 rounded-lg border border-blue-200">
                    <label for="student_ids" class="block text-gray-700 text-lg font-bold mb-4">Pilih Santri Penghuni:</label>

                    @if ($availableStudents->isEmpty())
                        <p class="text-gray-600 italic">Tidak ada santri yang tersedia untuk dipilih.</p>
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($availableStudents as $student)
                                <div class="flex items-center p-3 border border-gray-300 rounded-lg bg-white shadow-sm">
                                    <input
                                        type="checkbox"
                                        name="student_ids[]"
                                        id="student_{{ $student->id }}"
                                        value="{{ $student->id }}"
                                        class="form-checkbox h-5 w-5 text-indigo-600 rounded focus:ring-indigo-500"
                                        {{ in_array($student->id, $room->currentStudents->pluck('student_id')->toArray()) ? 'checked' : '' }}
                                    >
                                    <label for="student_{{ $student->id }}" class="ml-3 text-gray-800 text-base font-medium flex-grow">
                                        {{ $student->name }} <span class="text-gray-500 text-sm">({{ $student->nis }})</span>
                                        @if($student->currentRoomPlacement && $student->currentRoomPlacement->room_id != $room->id)
                                            <br><span class="text-orange-500 text-xs">(Saat ini di kamar: {{ $student->currentRoomPlacement->room->room_number ?? 'Tidak Diketahui' }})</span>
                                        @endif
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    @endif

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