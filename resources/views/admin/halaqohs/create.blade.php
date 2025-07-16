{{-- resources/views/admin/halaqohs/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Halaqoh')
@section('header_admin', 'Tambah Halaqoh Baru')

@section('admin_content')
<form action="{{ route('admin.halaqohs.store') }}" method="POST">
    @include('admin.halaqohs._form')
</form>
@endsection
