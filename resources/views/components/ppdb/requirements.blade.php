<div class="mb-10 space-y-6">

    {{-- Accordion: Persyaratan Pendaftaran --}}
    <div x-data="{ open: true }" class="bg-yellow-50 border-l-4 border-yellow-400 p-5 rounded-xl shadow" x-cloak>
        <button @click="open = !open" class="flex justify-between items-center w-full text-left">
            <div class="flex items-center">
                <x-heroicon-o-exclamation-circle class="w-5 h-5 text-yellow-500 mr-2" />
                <h3 class="text-base font-semibold text-yellow-700">Persyaratan Pendaftaran</h3>
            </div>
            <div class="flex-shrink-0">
                <svg x-show="!open" class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
                <svg x-show="open" x-cloak class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                </svg>
            </div>
        </button>

        <div x-show="open" x-collapse class="mt-4 text-sm text-gray-700 space-y-2">
            <ul class="list-inside space-y-2">
                <li class="flex items-start gap-2"><x-heroicon-o-document-text class="w-4 h-4 text-yellow-500" /> Fotokopi Akta Kelahiran</li>
                <li class="flex items-start gap-2"><x-heroicon-o-document-text class="w-4 h-4 text-yellow-500" /> Fotokopi Kartu Keluarga (KK)</li>
                <li class="flex items-start gap-2"><x-heroicon-o-academic-cap class="w-4 h-4 text-yellow-500" /> Fotokopi Ijazah Terakhir</li>
                <li class="flex items-start gap-2"><x-heroicon-o-camera class="w-4 h-4 text-yellow-500" /> Pas Foto ukuran 3x4 terbaru</li>
                <li class="flex items-start gap-2"><x-heroicon-o-phone class="w-4 h-4 text-yellow-500" /> Nomor HP aktif</li>
                <li class="flex items-start gap-2"><x-heroicon-o-pencil-square class="w-4 h-4 text-yellow-500" /> Surat Pernyataan Wali Santri</li>
                <li class="flex items-start gap-2"><x-heroicon-o-currency-dollar class="w-4 h-4 text-yellow-500" /> Biaya administrasi awal</li>
            </ul>
        </div>
    </div>

   {{-- Accordion Item: Alur Pendaftaran --}}
<div x-data="{ open: false }" class="bg-blue-50 border-l-4 border-blue-400 p-5 rounded-xl shadow" x-cloak>
    <button @click="open = !open" class="flex justify-between items-center w-full text-left">
        <div class="flex items-center">
            <x-heroicon-o-clock class="w-5 h-5 text-blue-500 mr-2" />
            <h3 class="text-base font-semibold text-blue-700">Alur Pendaftaran</h3>
        </div>
        <div class="flex-shrink-0">
            <svg x-show="!open" class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
            <svg x-show="open" x-cloak class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
            </svg>
        </div>
    </button>

    <div x-show="open" x-collapse class="mt-6">
        @php
            $steps = [
                ['text' => 'Mengisi Formulir Pendaftaran', 'icon' => 'document-text'],
                ['text' => 'Mengisi Surat Pernyataan Wali', 'icon' => 'pencil-square'],
                ['text' => 'Membayar Administrasi', 'icon' => 'currency-dollar'],
                ['text' => 'Test Masuk (Bacaan)', 'icon' => 'academic-cap'],
                ['text' => 'Pembagian Halaqoh', 'icon' => 'users'],
            ];
        @endphp

        <div class="grid gap-6 md:grid-cols-5 mt-4">
            @foreach ($steps as $index => $step)
                <div class="flex flex-col items-center text-center bg-white p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 group">
                    <div class="w-10 h-10 flex items-center justify-center bg-blue-600 text-white rounded-full font-bold text-sm shadow">
                        {{ $index + 1 }}
                    </div>
                    <x-dynamic-component :component="'heroicon-o-' . $step['icon']" class="w-6 h-6 text-blue-500 mt-3 mb-2 group-hover:scale-110 transition-transform duration-300" />
                    <p class="text-sm text-gray-700 font-medium leading-snug">{{ $step['text'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</div>


</div>
