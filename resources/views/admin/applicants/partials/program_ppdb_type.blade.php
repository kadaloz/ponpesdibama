<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2 pt-6">Program & Tipe Pendaftaran</h3>

{{-- Pilih Program --}}
<div>
    <label for="chosen_program" class="block text-sm font-medium text-gray-700">Program yang Diminati</label>
    <select name="chosen_program" id="chosen_program" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">Pilih Program</option>
        @foreach ($programs as $program)
            <option value="{{ $program->name }}" {{ old('chosen_program', $applicant->chosen_program) == $program->name ? 'selected' : '' }}>
                {{ $program->name }}
            </option>
        @endforeach
    </select>
    @error('chosen_program')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Tipe Pendaftaran --}}
<div class="mt-4">
    <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Pendaftaran Santri</label>
    <div class="flex flex-col sm:flex-row gap-4">
        <label class="inline-flex items-center">
            <input type="radio" name="ppdb_type" value="Asrama"
                   class="h-4 w-4 text-teal-600 border-gray-300 focus:ring-teal-500"
                   {{ old('ppdb_type', $applicant->ppdb_type) === 'Asrama' ? 'checked' : '' }}
                   onchange="toggleHalaqohPeriod()">
            <span class="ml-2 text-sm text-gray-800">Santri Asrama</span>
        </label>
        <label class="inline-flex items-center">
            <input type="radio" name="ppdb_type" value="Pulang-Pergi"
                   class="h-4 w-4 text-teal-600 border-gray-300 focus:ring-teal-500"
                   {{ old('ppdb_type', $applicant->ppdb_type) === 'Pulang-Pergi' ? 'checked' : '' }}
                   onchange="toggleHalaqohPeriod()">
            <span class="ml-2 text-sm text-gray-800">Santri Pulang-Pergi</span>
        </label>
    </div>
    @error('ppdb_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

{{-- Periode Ngaji (Hanya untuk Pulang-Pergi) --}}
<div id="halaqoh-period-group" class="{{ old('ppdb_type', $applicant->ppdb_type) === 'Pulang-Pergi' ? '' : 'hidden' }} mt-4">
    <label for="halaqoh_period" class="block text-sm font-medium text-gray-700">Periode Ngaji</label>
    <select name="halaqoh_period" id="halaqoh_period" class="mt-1 block w-full px-4 py-2 border rounded-md shadow-sm focus:ring-teal-500 focus:border-teal-500">
        <option value="">Pilih Periode Ngaji</option>
        @foreach ($halaqohPeriods as $period)
            <option value="{{ $period }}" {{ old('halaqoh_period', $applicant->halaqoh_period) === $period ? 'selected' : '' }}>
                Halaqoh {{ $period }}
            </option>
        @endforeach
    </select>
    @error('halaqoh_period')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
</div>

@push('scripts')
<script>
    function toggleHalaqohPeriod() {
        const selectedType = document.querySelector('input[name="ppdb_type"]:checked')?.value;
        const halaqohGroup = document.getElementById('halaqoh-period-group');
        const halaqohSelect = document.getElementById('halaqoh_period');

        if (selectedType === 'Pulang-Pergi') {
            halaqohGroup.classList.remove('hidden');
            halaqohSelect.setAttribute('required', 'required');
        } else {
            halaqohGroup.classList.add('hidden');
            halaqohSelect.removeAttribute('required');
            halaqohSelect.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', toggleHalaqohPeriod);
</script>
@endpush
