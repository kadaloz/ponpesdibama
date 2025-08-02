@extends('web.apps')

@section('title', 'Pendaftaran Berhasil - PonpesDIBAMA')
@section('meta_description', 'Pendaftaran PPDB online Anda telah berhasil. Simpan nomor pendaftaran untuk verifikasi dan daftar ulang.')
@section('meta_keywords', 'ppdb online, pendaftaran berhasil, pondok pesantren, pendidikan islam')
@section('meta_image', asset('storage/images/logo/pondok.png'))

@section('main_content')
<section class="py-24 md:py-40 bg-teal-600 text-white flex items-center justify-center min-h-[80vh] rounded-b-lg shadow-xl">
    <div class="container mx-auto text-center px-4">
        <h2 class="text-4xl md:text-5xl font-extrabold leading-tight mb-4 drop-shadow-md">
            Pendaftaran Berhasil Dikirim!
        </h2>
        <p class="text-xl md:text-2xl mb-8 opacity-90">
            Terima kasih telah mendaftar di Ponpes DIBAMA.
        </p>

        @if (session('success'))
            <p class="text-lg md:text-xl font-semibold mb-8 bg-white text-teal-800 p-4 rounded-lg shadow-md mx-auto max-w-lg">
                {{ session('success') }}
            </p>
        @endif

        <div class="bg-white text-gray-800 p-8 rounded-xl shadow-lg mx-auto max-w-lg">
            <h3 class="text-2xl font-bold text-teal-700 mb-4">Informasi Verifikasi Daftar Ulang</h3>
            <p class="mb-4 text-lg">
                Simpan nomor pendaftaran ini untuk proses verifikasi dan daftar ulang:
            </p>
            <p class="text-3xl md:text-4xl font-extrabold text-blue-700 mb-6 break-words">
                {{ $registrationNumber ?? 'Tidak Tersedia' }}
            </p>

            @if ($registrationNumber)
                <div class="mb-6">
                    <p class="text-sm text-gray-600 mb-2">QR Code Verifikasi:</p>
                    {{-- Element for QR Code --}}
                    <div id="qrcode" class="mx-auto w-full max-w-[250px] h-auto"></div>
                </div>

                <div class="flex flex-col items-center gap-4">
                    <a href="{{ route('applicant.print', $registrationNumber) }}"
                       class="inline-flex items-center px-6 py-3 bg-teal-600 text-white rounded-full text-md font-semibold shadow-md hover:bg-teal-700 transition-all duration-300">
                        Cetak Bukti Pendaftaran (PDF)
                    </a>
                    <p class="text-sm text-gray-600">
                        File PDF akan berisi data lengkap dan QR Code untuk verifikasi.
                    </p>
                </div>
            @endif

            <p class="text-md text-gray-600 mt-6">
                Silakan cetak halaman ini atau catat nomor pendaftaran Anda.
                Kami akan menghubungi Anda untuk informasi selanjutnya.
            </p>
        </div>

        <div class="mt-8">
            <a href="{{ url('/') }}" class="inline-flex items-center px-8 py-4 bg-white text-teal-700 rounded-full text-lg font-semibold shadow-lg transition-all duration-300 transform hover:scale-105">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</section>

@push('scripts')
{{-- Pustaka JsBarcode diganti dengan QRCodejs --}}
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const registrationNumber = "{{ $registrationNumber ?? '' }}";
        if (registrationNumber) {
            new QRCode(document.getElementById("qrcode"), {
                text: registrationNumber,
                width: 250,
                height: 250,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.H
            });
        }
    });
</script>
@endpush
@endsection
