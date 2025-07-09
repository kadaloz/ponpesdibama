<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Program & Dokumen</h3>

{{-- Pilih Program --}}
<x-form.select
    id="chosen_program"
    name="chosen_program"
    label="Pilih Program"
    :options="$programs->pluck('name', 'name')->toArray()"
    :selected="$applicant->chosen_program ?? ''"
    placeholder="Pilih Program"
/>

{{-- Tipe Pendaftaran --}}
<x-form.radio-group
    name="ppdb_type"
    label="Tipe Pendaftaran"
    :options="['Asrama' => 'Asrama', 'Pulang-Pergi' => 'Pulang-Pergi']"
    :checked="$applicant->ppdb_type ?? ''"
    onchange="toggleHalaqohPeriod()"
/>

{{-- Periode Halaqoh --}}
<div class="mb-4 hidden" id="halaqoh-period-group">
    <x-form.select
        id="halaqoh_period"
        name="halaqoh_period"
        label="Periode Ngaji"
        :options="['Sore' => 'Halaqoh Sore', 'Malam' => 'Halaqoh Malam']"
        :selected="$applicant->halaqoh_period ?? ''"
        placeholder="Pilih Periode"
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
