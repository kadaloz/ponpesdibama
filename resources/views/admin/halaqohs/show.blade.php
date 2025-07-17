<div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        {{-- Header --}}
        <div class="bg-teal-600 px-5 py-3 flex items-center justify-between">
            <div class="flex items-center">
                <x-heroicon-o-academic-cap class="h-6 w-6 text-white mr-2" />
                <h1 class="text-lg sm:text-xl font-bold text-white">Detail Halaqoh: {{ $halaqoh->name }}</h1>
            </div>
            <a href="{{ route('admin.halaqohs.index') }}"
               class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md bg-white text-teal-700 hover:bg-teal-100">
                <x-heroicon-o-arrow-left class="h-4 w-4 mr-1" />
                Kembali
            </a>
        </div>

        {{-- Konten Detail --}}
        <div class="p-6 space-y-6">
            {{-- Informasi Umum --}}
            <section class="border-b pb-4">
                <h2 class="text-base sm:text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <x-heroicon-o-information-circle class="h-5 w-5 text-gray-500 mr-2" />
                    Informasi Umum
                </h2>
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-sm sm:text-base">
                    <div>
                        <dt class="text-gray-500 font-medium">Nama Halaqoh</dt>
                        <dd class="text-gray-800 font-semibold mt-1">{{ $halaqoh->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 font-medium">Guru Ngaji</dt>
                        <dd class="text-gray-800 font-semibold mt-1">{{ $halaqoh->teacher->full_name ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 font-medium">Periode</dt>
                        <dd class="text-gray-800 font-semibold mt-1">{{ $halaqoh->period ?? '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 font-medium">Kuota Santri</dt>
                        <dd class="text-gray-800 font-semibold mt-1">
                            {{ $halaqoh->student_limit ? $halaqoh->student_limit . ' Santri' : 'Tidak ada batas' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-gray-500 font-medium">Status</dt>
                        <dd class="mt-1">
                            @if($halaqoh->status === 'active')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Aktif</span>
                            @elseif($halaqoh->status === 'inactive')
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">Tidak Aktif</span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">Selesai</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </section>

            {{-- Deskripsi --}}
            @if($halaqoh->description)
            <section>
                <h2 class="text-base sm:text-lg font-semibold text-gray-900 mb-3 flex items-center">
                    <x-heroicon-o-pencil class="h-5 w-5 text-gray-500 mr-2" />
                    Deskripsi
                </h2>
                <p class="text-gray-700 text-sm leading-relaxed">{{ $halaqoh->description }}</p>
            </section>
            @endif
        </div>

        {{-- Footer Aksi --}}
        <div class="bg-gray-50 px-5 py-3 flex flex-wrap justify-end gap-3 border-t">
            <a href="{{ route('admin.halaqohs.edit', $halaqoh->id) }}"
               class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md bg-indigo-600 text-white hover:bg-indigo-700">
                <x-heroicon-o-pencil-square class="h-4 w-4 mr-1" />
                Edit
            </a>

            <form action="{{ route('admin.halaqohs.destroy', $halaqoh->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus halaqoh ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-md bg-red-600 text-white hover:bg-red-700">
                    <x-heroicon-o-trash class="h-4 w-4 mr-1" />
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
