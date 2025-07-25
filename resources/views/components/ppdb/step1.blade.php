<h3 class="text-xl font-bold text-teal-700 mb-4 border-b pb-2">Data Calon Santri</h3>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    {{-- Nama Lengkap --}}
    <x-form.input
        id="full_name"
        name="full_name"
        label="Nama Lengkap"
        placeholder="Contoh: Ahmad Fulan"
        :value="$applicant->full_name ?? ''"
        required
        autofocus
    />

    {{-- Jenis Kelamin --}}
    <x-form.select
        id="gender"
        name="gender"
        label="Jenis Kelamin"
        :options="['Laki-laki' => 'laki-laki', 'Perempuan' => 'perempuan']"
        :selected="$applicant->gender ?? ''"
        placeholder="Pilih Jenis Kelamin"
        required
    />

    {{-- Tempat Lahir --}}
    <x-form.input
        id="place_of_birth"
        name="place_of_birth"
        label="Tempat Lahir"
        placeholder="Contoh: Mataram"
        :value="$applicant->place_of_birth ?? ''"
    />

{{-- Tanggal Lahir --}}
<x-form.input
    id="date_of_birth"
    name="date_of_birth"
    label="Tanggal Lahir"
    placeholder="Pilih tanggal lahir"
    :value="$applicant->date_of_birth ?? ''"
    class="flatpickr"
    data-max-date="{{ now()->subYears(7)->format('Y-m-d') }}"
    required
/>

    {{-- NISN --}}
    <x-form.input
        id="nisn"
        name="nisn"
        label="NISN"
        placeholder="10 digit NISN"
        :value="$applicant->nisn ?? ''"
    />

{{-- Pendidikan Terakhir --}}
    <x-form.select
        id="last_education"
        name="last_education"
        label="Pendidikan Terakhir"
        :options="[
            'SD/MI' => 'SD/MI',
            'SMP/MTS' => 'SMP/MTS',
            'SMA/MAN' => 'SMA/MAN',
            'Diploma' => 'Diploma',
            'Sarjana' => 'Sarjana',
            'Master' => 'Master',
            'Tidak Sekolah' => 'Tidak Sekolah'
      ]"
        :selected="$applicant->last_education ?? ''"
        placeholder="Pilih Pendidikan terakhir"
        required
/>

    {{-- Asal Sekolah --}}
    <x-form.input
        id="school_origin"
        name="school_origin"
        label="Asal Sekolah"
        placeholder="Contoh: SDN 1 Aikmel"
        :value="$applicant->school_origin ?? ''"
        class="md:col-span-2"
    />
</div>
