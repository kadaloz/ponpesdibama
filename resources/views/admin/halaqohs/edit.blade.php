{{-- resources/views/admin/halaqohs/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Halaqoh')
@section('header_admin', 'Edit Data Halaqoh')

@section('admin_content')
<form action="{{ route('halaqohs.update', $halaqoh) }}" method="POST">
    @method('PUT')
    @include('admin.halaqohs._form')
</form>
@endsection
