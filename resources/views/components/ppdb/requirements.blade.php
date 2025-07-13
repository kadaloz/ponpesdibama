<div class="mb-10 space-y-6">

   {{-- Accordion Item: Persyaratan Pendaftaran --}}
<div x-data="{ open: false }" class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-xl shadow" x-cloak>
    <button @click="open = !open" class="flex justify-between items-center w-full text-left">
        <div class="flex items-center">
            <x-heroicon-o-exclamation-circle class="w-6 h-6 text-yellow-500 mr-2" />
            <h3 class="text-lg font-bold text-yellow-700">Persyaratan Pendaftaran</h3>
        </div>
        <svg x-show="!open" class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7" />
        </svg>
        <svg x-show="open" x-cloak class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <div x-show="open" x-collapse class="mt-4 text-sm text-gray-700 transition-all duration-300 ease-in-out space-y-3">
        <ul class="list-inside space-y-2">
            <li class="flex items-start gap-2">
                <x-heroicon-o-document-text class="w-5 h-5 text-yellow-500 mt-0.5" />
                Fotokopi Akta Kelahiran
            </li>
            <li class="flex items-start gap-2">
                <x-heroicon-o-document-text class="w-5 h-5 text-yellow-500 mt-0.5" />
                Fotokopi Kartu Keluarga (KK)
            </li>
            <li class="flex items-start gap-2">
                <x-heroicon-o-academic-cap class="w-5 h-5 text-yellow-500 mt-0.5" />
                Fotokopi Ijazah Terakhir (jika sudah ada)
            </li>
            <li class="flex items-start gap-2">
                <x-heroicon-o-camera class="w-5 h-5 text-yellow-500 mt-0.5" />
                Pas Foto ukuran 3x4 terbaru
            </li>
            <li class="flex items-start gap-2">
                <x-heroicon-o-phone class="w-5 h-5 text-yellow-500 mt-0.5" />
                Nomor HP aktif yang bisa dihubungi
            </li>
            <li class="flex items-start gap-2">
                <x-heroicon-o-pencil-square class="w-5 h-5 text-yellow-500 mt-0.5" />
                Surat Pernyataan Wali Santri (bisa diunduh dan diisi manual)
            </li>
            <li class="flex items-start gap-2">
                <x-heroicon-o-currency-dollar class="w-5 h-5 text-yellow-500 mt-0.5" />
                Biaya administrasi awal (dibayar ke panitia)
            </li>
        </ul>
    </div>
</div>


{{-- Accordion Item: Alur Pendaftaran --}}
<div x-data="{ open: false }" class="bg-blue-50 border-l-4 border-blue-400 p-6 rounded-xl shadow" x-cloak>
    <button @click="open = !open" class="flex justify-between items-center w-full text-left">
        <div class="flex items-center">
            <svg class="w-6 h-6 text-blue-500 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0a9 9 0 0118 0z" />
            </svg>
            <h3 class="text-lg font-bold text-blue-700">Alur Pendaftaran</h3>
        </div>
        <svg x-show="!open" class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M19 9l-7 7-7-7" />
        </svg>
        <svg x-show="open" x-cloak class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor"
             viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 15l7-7 7 7" />
        </svg>
    </button>

    <div x-show="open" x-collapse class="mt-6">

        @php
            $steps = [
                ['text' => 'Mengisi Formulir Pendaftaran', 'icon' => 'document-text'],
                ['text' => 'Mengisi Surat Pernyataan Wali Santri', 'icon' => 'pencil-square'],
                ['text' => 'Membayar Administrasi', 'icon' => 'credit-card'],
                ['text' => 'Test Masuk (Bacaan)', 'icon' => 'book-open'],
                ['text' => 'Pembagian Halaqoh', 'icon' => 'users']
            ];
        @endphp

        <div class="flex flex-col md:flex-row md:justify-between md:space-x-4 space-y-6 md:space-y-0 relative">
            @foreach ($steps as $index => $step)
                <div class="relative flex-1 group">
                    @if (!$loop->last)
                        <div class="hidden md:block absolute top-6 right-0 w-full h-1 border-t-2 border-dashed border-blue-300 z-0 transform translate-x-1/2"></div>
                    @endif

                    <div class="relative z-10 flex flex-col items-center text-center px-5 py-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
                        {{-- Heroicon --}}
                        @switch($step['icon'])
                            @case('document-text')
                                <x-heroicon-o-document-text class="w-10 h-10 text-blue-600 mb-3" />
                                @break
                            @case('pencil-square')
                                <x-heroicon-o-pencil-square class="w-10 h-10 text-blue-600 mb-3" />
                                @break
                            @case('credit-card')
                                <x-heroicon-o-credit-card class="w-10 h-10 text-blue-600 mb-3" />
                                @break
                            @case('book-open')
                                <x-heroicon-o-book-open class="w-10 h-10 text-blue-600 mb-3" />
                                @break
                            @case('users')
                                <x-heroicon-o-user-group class="w-10 h-10 text-blue-600 mb-3" />
                                @break
                        @endswitch

                        {{-- Step Number --}}
                        <div class="mb-1 text-xs font-semibold text-blue-500">Langkah {{ $index + 1 }}</div>

                        {{-- Step Text --}}
                        <p class="text-sm font-medium text-gray-800">{{ $step['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

</div>
