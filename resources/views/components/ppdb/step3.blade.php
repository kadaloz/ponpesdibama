<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Program & Dokumen</h3>

{{-- Pilih Program --}}
<x-form.group label="Pilih Program" name="chosen_program" as="select">
    <option value="">Pilih Program</option>
    @foreach ($programs as $program)
        <option value="{{ $program->name }}" {{ old('chosen_program') == $program->name ? 'selected' : '' }}>
            {{ $program->name }}
        </option>
    @endforeach
</x-form.group>

{{-- Tipe Pendaftaran --}}
<div class="mt-4">
    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Pendaftaran</label>
    <div class="space-x-4">
        <label>
            <input type="radio" name="ppdb_type" value="Asrama"
                {{ old('ppdb_type') == 'Asrama' ? 'checked' : '' }}
                onchange="toggleHalaqohPeriod()"> Asrama
        </label>
        <label>
            <input type="radio" name="ppdb_type" value="Pulang-Pergi"
                {{ old('ppdb_type') == 'Pulang-Pergi' ? 'checked' : '' }}
                onchange="toggleHalaqohPeriod()"> Pulang-Pergi
        </label>
    </div>
    @error('ppdb_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Periode Halaqoh --}}
<div class="mt-4 hidden" id="halaqoh-period-group">
    <x-form.group label="Periode Ngaji" name="halaqoh_period" as="select">
        <option value="">Pilih Periode</option>
        <option value="Sore" {{ old('halaqoh_period') == 'Sore' ? 'selected' : '' }}>Halaqoh Sore</option>
        <option value="Malam" {{ old('halaqoh_period') == 'Malam' ? 'selected' : '' }}>Halaqoh Malam</option>
    </x-form.group>
</div>

{{-- Dokumen Upload --}}
<div class="space-y-4 pt-6">
    @foreach ([
        'akta' => 'Akta Kelahiran',
        'kk' => 'Kartu Keluarga (KK)',
        'ijazah' => 'Ijazah Terakhir',
        'photo' => 'Pas Foto'
    ] as $key => $label)
        <div>
            <label for="document_{{ $key }}" class="block text-sm font-semibold text-gray-700 mb-1">{{ $label }}</label>
            <input type="file" name="document_{{ $key }}" id="document_{{ $key }}"
                accept=".pdf,.jpg,.jpeg,.png"
                class="mt-1 block w-full text-sm text-gray-500 file:py-2 file:px-4 file:border-0 file:rounded-md file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
            @error("document_$key")<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>
    @endforeach
</div>
