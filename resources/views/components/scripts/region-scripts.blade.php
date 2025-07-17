{{-- resources/views/students/partials/region-scripts.blade.php --}}

@props(['student' => null])

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const provinsiSelect = document.getElementById('province');
        const kabupatenSelect = document.getElementById('city');
        const kecamatanSelect = document.getElementById('district');
        const kelurahanSelect = document.getElementById('village');

        // Untuk edit mode, gunakan nilai lama atau dari $student
        const selectedProv = "{{ old('province', $student->province ?? '') }}";
        const selectedKab = "{{ old('city', $student->city ?? '') }}";
        const selectedKec = "{{ old('district', $student->district ?? '') }}";
        const selectedKel = "{{ old('village', $student->village ?? '') }}";

        fetch('/api/provinces')
            .then(res => res.json())
            .then(provinces => {
                provinces.forEach(prov => {
                    const option = new Option(prov, prov, false, prov === selectedProv);
                    provinsiSelect.appendChild(option);
                });
                if (selectedProv) updateCities(selectedProv);
            })
            .catch(() => console.error('❌ Gagal memuat data provinsi.')); // Ubah alert ke console.error

        provinsiSelect.addEventListener('change', function () {
            updateCities(this.value);
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
        });

        kabupatenSelect.addEventListener('change', function () {
            updateDistricts(provinsiSelect.value, this.value);
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
        });

        kecamatanSelect.addEventListener('change', function () {
            updateVillages(provinsiSelect.value, kabupatenSelect.value, this.value);
        });

        function updateCities(provinsi) {
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            if (!provinsi) return; // Jangan fetch jika provinsi kosong
            fetch(`/api/cities?province=${encodeURIComponent(provinsi)}`)
                .then(res => res.json())
                .then(cities => {
                    cities.forEach(kab => {
                        const option = new Option(kab, kab, false, kab === selectedKab);
                        kabupatenSelect.appendChild(option);
                    });
                    if (selectedKab && kabupatenSelect.value === selectedKab) updateDistricts(provinsi, selectedKab);
                })
                .catch(() => console.error('❌ Gagal memuat data kota/kabupaten.'));
        }

        function updateDistricts(provinsi, kota) {
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            if (!provinsi || !kota) return;
            fetch(`/api/districts?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}`)
                .then(res => res.json())
                .then(districts => {
                    districts.forEach(kec => {
                        const option = new Option(kec, kec, false, kec === selectedKec);
                        kecamatanSelect.appendChild(option);
                    });
                    if (selectedKec && kecamatanSelect.value === selectedKec) updateVillages(provinsi, kota, selectedKec);
                })
                .catch(() => console.error('❌ Gagal memuat data kecamatan.'));
        }

        function updateVillages(provinsi, kota, kecamatan) {
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
            if (!provinsi || !kota || !kecamatan) return;
            fetch(`/api/villages?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}&district=${encodeURIComponent(kecamatan)}`)
                .then(res => res.json())
                .then(villages => {
                    villages.forEach(kel => {
                        const option = new Option(kel, kel, false, kel === selectedKel);
                        kelurahanSelect.appendChild(option);
                    });
                })
                .catch(() => console.error('❌ Gagal memuat data kelurahan.'));
        }
    });

    function toggleHalaqohPeriodStudent() {
        const ppdbTypeRadio = document.querySelector('input[name="type"]:checked');
        const halaqohPeriodGroup = document.getElementById('halaqoh-period-group-student');
        const halaqohPeriodSelect = document.getElementById('halaqoh_period');

        if (ppdbTypeRadio && ppdbTypeRadio.value === 'Pulang-Pergi') {
            halaqohPeriodGroup.classList.remove('hidden');
            halaqohPeriodSelect.setAttribute('required', 'required');
        } else {
            halaqohPeriodGroup.classList.add('hidden');
            halaqohPeriodSelect.removeAttribute('required');
            halaqohPeriodSelect.value = '';
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        toggleHalaqohPeriodStudent();
    });
</script>
@endpush