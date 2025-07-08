<div class="mb-10 space-y-8">

    {{-- Persyaratan Pendaftaran --}}
    <x-form.info-card title="Persyaratan Pendaftaran" color="yellow" accordion>
        <ul class="list-disc list-inside space-y-1 pl-1">
            <li>Fotokopi Akta Kelahiran</li>
            <li>Fotokopi Kartu Keluarga (KK)</li>
            <li>Fotokopi Ijazah Terakhir (jika sudah ada)</li>
            <li>Pas Foto ukuran 3x4 terbaru</li>
            <li>Nomor HP aktif yang bisa dihubungi</li>
            <li>Surat Pernyataan Wali Santri (bisa diunduh dan diisi manual)</li>
            <li>Biaya administrasi awal (dibayar ke panitia)</li>
        </ul>
    </x-form.info-card>

    {{-- Alur Pendaftaran --}}
    @php
        $steps = [
            'Mengisi Formulir Pendaftaran',
            'Mengisi Surat Pernyataan Wali Santri',
            'Membayar Administrasi',
            'Test Masuk (Bacaan)',
            'Pembagian Halaqoh'
        ];
    @endphp

    <x-form.info-card title="Alur Pendaftaran" color="blue">
        <div class="flex flex-col md:flex-row md:justify-between md:space-x-4 space-y-6 md:space-y-0 relative">
            @foreach ($steps as $index => $step)
                <div class="relative flex-1 group">
                    @if (!$loop->last)
                        <div class="hidden md:block absolute top-6 right-0 w-full h-1 border-t-2 border-dashed border-blue-300 z-0 transform translate-x-1/2"></div>
                    @endif

                    <div class="relative z-10 flex flex-col items-center text-center px-5 py-6 bg-white rounded-xl shadow-md hover:shadow-lg transition-all duration-300 ease-in-out">
                        <div class="mb-2 flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full text-sm font-bold shadow-md">
                            {{ $index + 1 }}
                        </div>
                        <p class="text-sm font-medium text-gray-800">{{ $step }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </x-form.info-card>

</div>
