<div class="mb-10 space-y-8">

    {{-- Persyaratan Pendaftaran (Accordion) --}}
    <div x-data="{ open: false }" class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-xl shadow" x-cloak>
        <div class="flex justify-between items-center cursor-pointer" @click="open = !open">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2l4 -4M12 20a8 8 0 100-16a8 8 0 000 16z" />
                </svg>
                <h3 class="text-lg font-bold text-yellow-700">Persyaratan Pendaftaran</h3>
            </div>
            <svg x-show="!open" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            <svg x-show="open" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </div>
        <div x-show="open" class="mt-4 text-sm text-gray-700 transition-all duration-300 ease-in-out">
            <ul class="list-disc list-inside space-y-1 pl-1">
                <li>Fotokopi Akta Kelahiran</li>
                <li>Fotokopi Kartu Keluarga (KK)</li>
                <li>Fotokopi Ijazah Terakhir (jika sudah ada)</li>
                <li>Pas Foto ukuran 3x4 terbaru</li>
                <li>Nomor HP aktif yang bisa dihubungi</li>
                <li>Surat Pernyataan Wali Santri (bisa diunduh dan diisi manual)</li>
                <li>Biaya administrasi awal (dibayar ke panitia)</li>
            </ul>
        </div>
    </div>

{{-- Alur Pendaftaran (Kartu Responsif Tanpa Ikon) --}}
<div class="bg-blue-50 border-l-4 border-blue-400 p-6 rounded-xl shadow">
    <div class="flex items-center mb-6">
        <h3 class="text-lg font-bold text-blue-700 flex items-center">
            <svg class="w-6 h-6 text-blue-500 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>
            Alur Pendaftaran
        </h3>
    </div>

    @php
        $steps = [
            'Mengisi Formulir Pendaftaran',
            'Mengisi Surat Pernyataan Wali Santri',
            'Membayar Administrasi',
            'Test Masuk (Bacaan)',
            'Pembagian Halaqoh'
        ];
    @endphp

    <div class="flex flex-col md:flex-row md:justify-between md:space-x-4 space-y-6 md:space-y-0 relative">
        @foreach ($steps as $index => $step)
            <div class="relative flex-1 group">
                {{-- Garis penghubung antar langkah (desktop only) --}}
                @if (!$loop->last)
                    <div class="hidden md:block absolute top-6 right-0 w-full h-1 border-t-2 border-dashed border-blue-300 z-0 transform translate-x-1/2"></div>
                @endif

                {{-- Kartu langkah --}}
                <div class="relative z-10 flex flex-col items-center text-center px-5 py-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
                    <div class="mb-2 flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full text-sm font-bold shadow-md">
                        {{ $index + 1 }}
                    </div>
                    <p class="text-sm font-medium text-gray-800">{{ $step }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

