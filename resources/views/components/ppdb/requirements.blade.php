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

    {{-- Accordion: Alur Pendaftaran --}}
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

        <div x-show="open" x-collapse class="mt-5">
            @php
                $steps = [
                    ['text' => 'Mengisi Formulir Pendaftaran', 'icon' => 'document-text'],
                    ['text' => 'Mengisi Surat Pernyataan Wali', 'icon' => 'pencil-square'],
                    ['text' => 'Membayar Administrasi', 'icon' => 'currency-dollar'],
                    ['text' => 'Test Masuk (Bacaan)', 'icon' => 'academic-cap'],
                    ['text' => 'Pembagian Halaqoh', 'icon' => 'users'],
                ];
            @endphp

            <div class="flex flex-col md:flex-row md:justify-between md:space-x-4 space-y-6 md:space-y-0 relative mt-2">
                @foreach ($steps as $index => $step)
                    <div class="relative flex-1 group">
                        @if (!$loop->last)
                            <div class="hidden md:block absolute top-6 right-0 w-full h-1 border-t-2 border-dashed border-blue-300 z-0 transform translate-x-1/2"></div>
                        @endif

                        <div class="relative z-10 flex flex-col items-center text-center px-4 py-5 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300">
                            <div class="mb-2 flex items-center justify-center w-9 h-9 bg-blue-600 text-white rounded-full text-xs font-bold shadow">
                                {{ $index + 1 }}
                            </div>
                            <x-dynamic-component :component="'heroicon-o-' . $step['icon']" class="w-5 h-5 text-blue-500 mb-1" />
                            <p class="text-sm font-medium text-gray-800">{{ $step['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
