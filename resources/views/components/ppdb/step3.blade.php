<div x-data="{ ppdbType: '{{ old('ppdb_type', $applicant->ppdb_type ?? '') }}' }">
    <h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Program & Dokumen</h3>

    {{-- Pilih Program --}}
    <x-form.group name="chosen_program" label="Pilih Program">
        <x-form.select
            id="chosen_program"
            name="chosen_program"
            :options="$programs->pluck('name', 'name')->toArray()"
            :selected="old('chosen_program', $applicant->chosen_program ?? '')"
            placeholder="Pilih Program"
        />
    </x-form.group>

    {{-- Tipe Pendaftaran --}}
    <x-form.group name="ppdb_type" label="Tipe Pendaftaran">
        <div class="flex flex-col gap-2 sm:flex-row sm:gap-6">
            <label class="inline-flex items-center space-x-2">
                <input
                    type="radio"
                    name="ppdb_type"
                    value="Asrama"
                    x-model="ppdbType"
                    {{ empty($settings['ppdb_asrama_open']) ? 'disabled' : '' }}
                    {{ old('ppdb_type', $applicant->ppdb_type ?? '') === 'Asrama' ? 'checked' : '' }}
                >
                <span>Asrama</span>
            </label>

            <label class="inline-flex items-center space-x-2">
                <input
                    type="radio"
                    name="ppdb_type"
                    value="Pulang-Pergi"
                    x-model="ppdbType"
                    {{ empty($settings['ppdb_pulang_pergi_open']) ? 'disabled' : '' }}
                    {{ old('ppdb_type', $applicant->ppdb_type ?? '') === 'Pulang-Pergi' ? 'checked' : '' }}
                >
                <span>Pulang-Pergi</span>
            </label>
        </div>
    </x-form.group>

    {{-- Periode Halaqoh --}}
<select
    id="halaqoh_period"
    name="halaqoh_period"
    class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-teal-500 focus:border-teal-500"
    data-required-if="ppdb_type:Pulang-Pergi"
>
    <option value="">Pilih Periode</option>
   @foreach (\App\Enums\HalaqohPeriod::cases() as $period)
    <option value="{{ $period->value }}"
        {{ old('halaqoh_period', $applicant->halaqoh_period ?? '') === $period->value ? 'selected' : '' }}>
        {{ $period->label() }}
    </option>
@endforeach

</select>


    {{-- Dokumen Upload --}}
    <div class="space-y-4 pt-6">
        @foreach ([
            'akta' => 'Akta Kelahiran',
            'kk' => 'Kartu Keluarga (KK)',
            'ijazah' => 'Ijazah Terakhir',
            'photo' => 'Pas Foto'
        ] as $key => $label)
            <x-form.group name="document_{{ $key }}" label="{{ $label }}">
                <x-form.file
                    id="document_{{ $key }}"
                    name="document_{{ $key }}"
                    accept=".pdf,.jpg,.jpeg,.png"
                />
            </x-form.group>
        @endforeach
    </div>
</div>
