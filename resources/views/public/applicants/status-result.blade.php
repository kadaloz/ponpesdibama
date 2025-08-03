@extends('web.apps')
@section('title', 'Cek Status Pendaftaran - PonpesDIBAMA')
@section('meta_description', 'Cek status pendaftaran Anda di PonpesDIBAMA. Masukkan nomor pendaftaran untuk melihat status.')
@section('meta_keywords', 'ppdb online, cek status pendaftaran, pondok pesantren, pendidikan islam')
@section('meta_image', asset('storage/images/logo/pondok.png'))
@section('main_content')
<div class="max-w-xl mx-auto mt-10">
    <h2 class="text-xl font-bold mb-4">Status Pendaftaran</h2>

    <table class="w-full text-sm border rounded">
        <tr>
            <th class="text-left p-2 border">Nomor Registrasi</th>
            <td class="p-2 border">{{ $applicant->registration_number }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border">Nama Lengkap</th>
            <td class="p-2 border">{{ $applicant->name }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border">Status</th>
            <td class="p-2 border">{{ ucfirst($applicant->status) }}</td>
        </tr>
        <tr>
            <th class="text-left p-2 border">Tanggal Pendaftaran</th>
            <td class="p-2 border">{{ $applicant->created_at->format('d M Y') }}</td>
        </tr>
    </table>

    <a href="{{ route('ppdb.applicants.status') }}" class="mt-6 inline-block text-blue-600 hover:underline">
        Cek Nomor Lain
    </a>
</div>
@endsection
