@php
    $programs = \App\Models\Program::where('is_active', true)->get();
@endphp

<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Pilihan Program & Tipe Santri & Unggah Dokumen</h3>

<div>
    <label for="chosen_program" class="block text-sm font-medium text-gray-700">Pilih Program Diminati</label>
    <select name="chosen_program" id="chosen_program" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">Pilih Program</option>
        @foreach ($programs as $program)
            <option value="{{ $program->name }}" {{ old('chosen_program') == $program->name ? 'selected' : '' }}>{{ $program->name }}</option>
        @endforeach
    </select>
    @error('chosen_program')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

<div>
    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Pendaftaran Santri</label>
    <div class="mt-2 flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
        <div>
            <input type="radio" name="ppdb_type" id="type_asrama" value="Asrama"
                   class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300"
                   {{ old('ppdb_type') == 'Asrama' ? 'checked' : '' }} required onchange="toggleHalaqohPeriod()">
            <label for="type_asrama" class="ml-2 text-sm text-gray-900">Program Santri Asrama</label>
        </div>
        <div>
            <input type="radio" name="ppdb_type" id="type_pulang_pergi" value="Pulang-Pergi"
                   class="focus:ring-teal-500 h-4 w-4 text-teal-600 border-gray-300"
                   {{ old('ppdb_type') == 'Pulang-Pergi' ? 'checked' : '' }} required onchange="toggleHalaqohPeriod()">
            <label for="type_pulang_pergi" class="ml-2 text-sm text-gray-900">Program Santri Pulang Pergi</label>
        </div>
    </div>
    @error('ppdb_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

<div id="halaqoh-period-group" class="hidden">
    <label for="halaqoh_period" class="block text-sm font-medium text-gray-700">Periode Ngaji</label>
    <select name="halaqoh_period" id="halaqoh_period" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">Pilih Periode Ngaji</option>
        <option value="Sore" {{ old('halaqoh_period') == 'Sore' ? 'selected' : '' }}>Halaqoh Sore</option>
        <option value="Malam" {{ old('halaqoh_period') == 'Malam' ? 'selected' : '' }}>Halaqoh Malam</option>
    </select>
    @error('halaqoh_period')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

<script>
    function toggleHalaqohPeriod() {
        const group = document.getElementById('halaqoh-period-group');
        const pulangPergi = document.getElementById('type_pulang_pergi').checked;
        group.classList.toggle('hidden', !pulangPergi);
    }
    window.addEventListener('DOMContentLoaded', toggleHalaqohPeriod);
</script>
