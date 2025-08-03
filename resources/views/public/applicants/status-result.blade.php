@extends('web.apps')
@section('title', 'Status Pendaftaran - PonpesDIBAMA')
@section('meta_description', 'Informasi pendaftaran Anda di Ponpes DIBAMA.')
@section('meta_keywords', 'ppdb online, cek status pendaftaran, pondok pesantren, pendidikan islam')
@section('meta_image', asset('storage/images/logo/pondok.png'))

@section('main_content')
<section class="py-16 bg-gray-100 min-h-screen">
    <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white p-8 md:p-10 rounded-xl shadow-lg border border-gray-200">
            <div class="text-center mb-6">
                <h2 class="text-3xl font-bold text-gray-100 mb-2">Status Pendaftaran</h2>
                <p class="text-gray-600">Informasi pendaftaran Anda di Ponpes DIBAMA.</p>
            </div>

            <div class="bg-blue-50 text-blue-800 p-4 rounded-lg text-center mb-6">
                <p class="text-lg font-semibold">Status Pendaftaran Saat Ini:</p>
                @php
                    $status = strtolower($applicant->status);
                    $statusColor = 'bg-gray-100';
                    $translatedStatus = 'Tidak Diketahui';

                    switch ($status) {
                        case 'submitted':
                            $statusColor = 'bg-blue-100';
                            $translatedStatus = 'Telah Dikirim';
                            break;
                        case 'pending':
                            $statusColor = 'bg-blue-100';
                            $translatedStatus = 'Menunggu';
                            break;
                        case 're-registered':
                            $statusColor = 'bg-blue-100';
                            $translatedStatus = 'Daftar Ulang';
                            break;
                        case 'under review':
                            $statusColor = 'bg-yellow-100';
                            $translatedStatus = 'Sedang Ditinjau';
                            break;
                        case 'verified':
                            $statusColor = 'bg-indigo-100';
                            $translatedStatus = 'Terverifikasi';
                            break;
                        case 'accepted':
                            $statusColor = 'bg-green-100';
                            $translatedStatus = 'Diterima';
                            break;
                        case 'rejected':
                            $statusColor = 'bg-red-100';
                            $translatedStatus = 'Ditolak';
                            break;
                        default:
                            $translatedStatus = ucfirst($status);
                            break;
                    }
                @endphp
                <span class="mt-2 inline-block px-4 py-1 rounded-full text-white text-sm font-bold {{ $statusColor }}">
                    {{ $translatedStatus }}
                </span>
            </div>

            <div class="space-y-4 text-gray-700">
                <div class="flex flex-col md:flex-row md:justify-between border-b pb-2">
                    <span class="font-semibold text-gray-600 md:w-1/3">Nomor Registrasi</span>
                    <span class="text-lg font-medium md:w-2/3 md:text-right">{{ $applicant->registration_number }}</span>
                </div>
                <div class="flex flex-col md:flex-row md:justify-between border-b pb-2">
                    <span class="font-semibold text-gray-600 md:w-1/3">Nama Lengkap</span>
                    <span class="text-lg font-medium md:w-2/3 md:text-right">{{ $applicant->full_name }}</span>
                </div>
                <div class="flex flex-col md:flex-row md:justify-between border-b pb-2">
                    <span class="font-semibold text-gray-600 md:w-1/3">Tanggal Pendaftaran</span>
                    <span class="text-lg font-medium md:w-2/3 md:text-right">{{ $applicant->created_at->format('d M Y') }}</span>
                </div>
            </div>

            <div class="mt-8 flex justify-center">
                <a href="{{ route('ppdb.applicants.status') }}" class="px-6 py-3 bg-teal-600 text-white font-semibold rounded-full shadow-lg hover:bg-teal-700 transition-colors">
                    Cek Nomor Lain
                </a>
            </div>
        </div>
    </div>
</section>
@endsection