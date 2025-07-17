<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
        {{-- Header dengan Hero Icon --}}
        <div class="bg-teal-600 px-6 py-4 flex items-center justify-between">
            <div class="flex items-center">
                <x-heroicon-o-academic-cap class="h-8 w-8 text-white mr-3" />
                <h1 class="text-2xl font-bold text-white">Detail Halaqoh: {{ $halaqoh->name }}</h1>
            </div>
            <a href="{{ route('halaqoh.index') }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-teal-500 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                <x-heroicon-o-arrow-left class="h-5 w-5 mr-2" />
                Kembali ke Daftar
            </a>
        </div>

        {{-- Detail Halaqoh --}}
        <div class="p-6 space-y-6">
            {{-- Informasi Umum --}}
            <div class="border-b border-gray-200 pb-5">
                <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                    <x-heroicon-o-information-circle class="h-6 w-6 text-gray-500 mr-2" />
                    Informasi Umum
                </h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Nama Halaqoh</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $halaqoh->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Guru Ngaji</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $halaqoh->teacher->full_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Periode Ngaji</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $halaqoh->period }}</dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Batas Maksimal Santri</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">
                            @if($halaqoh->student_limit)
                                {{ $halaqoh->student_limit }} Santri
                            @else
                                <span class="text-gray-500">Tidak ada batas</span>
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Status Halaqoh</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900 capitalize">
                            @if($halaqoh->status == 'active')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @elseif($halaqoh->status == 'inactive')
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Tidak Aktif
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                    Selesai
                                </span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>

            {{-- Deskripsi (Opsional) --}}
            @if($halaqoh->description)
            <div class="pt-5">
                <h2 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                    <x-heroicon-o-pencil-alt class="h-6 w-6 text-gray-500 mr-2" />
                    Deskripsi
                </h2>
                <p class="text-gray-700 leading-relaxed">{{ $halaqoh->description }}</p>
            </div>
            @endif
        </div>

        {{-- Footer dengan Tombol Aksi --}}
        <div class="bg-gray-50 px-6 py-4 flex justify-end space-x-3 border-t border-gray-200">
            <a href="{{ route('halaqoh.edit', $halaqoh->id) }}"
               class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <x-heroicon-o-pencil class="h-5 w-5 mr-2" />
                Edit Halaqoh
            </a>
            {{-- Tombol Hapus (Contoh: menggunakan form untuk DELETE request) --}}
            <form action="{{ route('halaqoh.destroy', $halaqoh->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus halaqoh ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <x-heroicon-o-trash class="h-5 w-5 mr-2" />
                    Hapus Halaqoh
                </button>
            </form>
        </div>
    </div>
</div>