<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Program & Dokumen</h3>

{{-- Pilih Program --}}
<x-form.select
    id="chosen_program"
    name="chosen_program"
    label="Pilih Program"
    :options="$programs->pluck('name', 'name')->toArray()"
    :selected="old('chosen_program', $applicant->chosen_program ?? '')"
    placeholder="Pilih Program"
/>

{{-- Tipe Pendaftaran --}}
<x-form.enum-radio
    name="ppdb_type"
    label="Tipe Pendaftaran"
    enum="\App\Enums\PpdbType"
    :checked="old('ppdb_type', $applicant->ppdb_type ?? '')"
/>


{{-- Periode Halaqoh --}}
<div class="mb-4" id="halaqoh-period-group" x-show="showHalaqoh" x-transition>
    <x-form.enum-select
        name="halaqoh_period"
        label="Periode Ngaji"
        enum="\App\Enums\HalaqohPeriod"
        :selected="old('halaqoh_period', $applicant->halaqoh_period ?? '')"
        placeholder="Pilih Periode"
        x-bind:required="showHalaqoh"
/>
</div>

{{-- Dokumen Upload --}}
<div class="space-y-4 pt-6">
    @foreach ([
        'akta' => 'Akta Kelahiran',
        'kk' => 'Kartu Keluarga (KK)',
        'ijazah' => 'Ijazah Terakhir',
        'photo' => 'Pas Foto'
    ] as $key => $label)
        <x-form.file
            id="document_{{ $key }}"
            name="document_{{ $key }}"
            label="{{ $label }}"
            accept=".pdf,.jpg,.jpeg,.png"
/>
    @endforeach
</div>
