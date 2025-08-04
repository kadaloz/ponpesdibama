@extends('layouts.admin')

@section('title', 'Edit Pembayaran')

@section('admin_content')
<div class="bg-white p-6 rounded shadow-md max-w-2xl mx-auto">
    <h2 class="text-2xl font-bold mb-6 text-gray-700">Edit Pembayaran</h2>

    @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-700 p-4 rounded">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.payments.update', $payment) }}">
        @csrf
        @method('PUT')

        {{-- Pilih Santri --}}
<div class="mb-4">
    <label for="student_id" class="block font-medium text-sm text-gray-700">Santri</label>
    <select name="student_id" id="student_id" required class="w-full">
        <option value="">-- Pilih Santri --</option>
        @foreach ($students as $student)
            <option value="{{ $student->id }}"
                {{ old('student_id', $payment->student_id ?? '') == $student->id ? 'selected' : '' }}>
                {{ $student->name }} ({{ $student->nis ?? 'NIS-' . $student->id }})
            </option>
        @endforeach
    </select>

    @error('student_id')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>

     {{-- Kategori Pembayaran --}}
        <div class="mb-4">
            <label for="category_id" class="block font-medium text-sm text-gray-700">Kategori Pembayaran</label>
            <select name="category_id" id="category_id" required class="form-select w-full border-gray-300 rounded mt-1">
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $payment->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Bulan --}}
<div class="mb-4">
    <label for="month" class="block font-medium text-sm text-gray-700">Bulan (opsional)</label>
    <input type="text" name="month" id="month_picker" placeholder="Misal: Januari 2025"
           class="form-input w-full border-gray-300 rounded mt-1"
           value="{{ old('month', $payment->month ?? '') }}">
    @error('month')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


        {{-- Nominal --}}
<div class="mb-4">
    <label for="amount" class="block font-medium text-sm text-gray-700">Jumlah Bayar</label>
    <input type="text" name="amount" id="amount" required
           class="form-input w-full border-gray-300 rounded mt-1 text-right"
           value="{{ old('amount', isset($payment) ? number_format($payment->amount, 0, ',', '.') : '') }}"
           placeholder="Contoh: 400.000">
    @error('amount')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


        {{-- Tanggal Bayar --}}
        <div class="mb-4">
            <label for="paid_at" class="block font-medium text-sm text-gray-700">Tanggal Bayar</label>
            <input type="text" name="paid_at" id="paid_at_picker" required
       class="form-input w-full border-gray-300 rounded mt-1"
       placeholder="Pilih tanggal bayar..."
       value="{{ old('paid_at', isset($payment) ? $payment->paid_at->format('Y-m-d') : '') }}">
            @error('paid_at')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Metode --}}
<div class="mb-4">
    <label for="method" class="block font-medium text-sm text-gray-700">Metode Pembayaran</label>
    <select name="method" id="method" class="form-select w-full border-gray-300 rounded mt-1" required>
        <option value="">-- Pilih Metode --</option>
        <option value="Tunai" {{ old('method', $payment->method) == 'Tunai' ? 'selected' : '' }}>Tunai</option>
        <option value="Transfer" {{ old('method', $payment->method) == 'Transfer' ? 'selected' : '' }}>Transfer</option>
        <option value="QRIS" {{ old('method', $payment->method) == 'QRIS' ? 'selected' : '' }}>QRIS</option>
        <option value="Bank" {{ old('method', $payment->method) == 'Bank' ? 'selected' : '' }}>Bank</option>
        <option value="E-Wallet" {{ old('method', $payment->method) == 'E-Wallet' ? 'selected' : '' }}>E-Wallet</option>
    </select>

    @error('method')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>


        {{-- Catatan --}}
        <div class="mb-6">
            <label for="note" class="block font-medium text-sm text-gray-700">Catatan</label>
            <textarea name="note" id="note" rows="3"
                      class="form-textarea w-full border-gray-300 rounded mt-1">{{ old('note', $payment->note) }}</textarea>
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.payments.index') }}"
               class="mr-4 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Batal</a>
            <button type="submit"
                    class="px-4 py-2 bg-teal-600 text-white rounded hover:bg-teal-700">
                Update Pembayaran
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    new TomSelect('#student_id', {
        placeholder: 'Cari santri...',
        allowEmptyOption: true,
        maxOptions: 20,
    });
</script>
@endpush
