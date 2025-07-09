<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Program & Dokumen</h3>

{{-- Pilih Program --}}
<div class="mb-4">
    <label for="chosen_program" class="block text-sm font-semibold text-gray-700 mb-1">Pilih Program</label>
    <select name="chosen_program" id="chosen_program"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">Pilih Program</option>
        @foreach ($programs as $program)
            <option value="{{ $program->name }}" {{ old('chosen_program') == $program->name ? 'selected' : '' }}>
                {{ $program->name }}
            </option>
        @endforeach
    </select>
    @error('chosen_program')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Tipe Pendaftaran --}}
<div class="mb-4">
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
<div class="mb-4 hidden" id="halaqoh-period-group">
    <label for="halaqoh_period" class="block text-sm font-semibold text-gray-700 mb-1">Periode Ngaji</label>
    <select name="halaqoh_period" id="halaqoh_period"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">Pilih Periode</option>
        <option value="Sore" {{ old('halaqoh_period') == 'Sore' ? 'selected' : '' }}>Halaqoh Sore</option>
        <option value="Malam" {{ old('halaqoh_period') == 'Malam' ? 'selected' : '' }}>Halaqoh Malam</option>
    </select>
    @error('halaqoh_period')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
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
