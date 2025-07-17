{{-- resources/views/components/scripts/region-scripts.blade.php --}}

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

        // Fungsi untuk mengupdate dropdown kota/kabupaten
        function updateCities(provinsi) {
            kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>'; // Clear lower levels
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>'; // Clear lower levels

            if (!provinsi) return;

            fetch(`/api/cities?province=${encodeURIComponent(provinsi)}`)
                .then(res => res.json())
                .then(cities => {
                    cities.forEach(kab => {
                        const option = new Option(kab, kab, false, kab === selectedKab);
                        kabupatenSelect.appendChild(option);
                    });
                    // *** PENTING: Jika ada selectedKab, panggil updateDistricts setelah kota terisi ***
                    if (selectedKab && kabupatenSelect.value === selectedKab) {
                        updateDistricts(provinsi, selectedKab);
                    } else {
                        // Jika tidak ada selectedKab atau tidak cocok, pastikan dropdown bawah bersih
                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    }
                })
                .catch(() => console.error('❌ Gagal memuat data kota/kabupaten.'));
        }

        // Fungsi untuk mengupdate dropdown kecamatan
        function updateDistricts(provinsi, kota) {
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>'; // Clear lower level

            if (!provinsi || !kota) return;

            fetch(`/api/districts?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}`)
                .then(res => res.json())
                .then(districts => {
                    districts.forEach(kec => {
                        const option = new Option(kec, kec, false, kec === selectedKec);
                        kecamatanSelect.appendChild(option);
                    });
                    // *** PENTING: Jika ada selectedKec, panggil updateVillages setelah kecamatan terisi ***
                    if (selectedKec && kecamatanSelect.value === selectedKec) {
                        updateVillages(provinsi, kota, selectedKec);
                    } else {
                         // Jika tidak ada selectedKec atau tidak cocok, pastikan dropdown bawah bersih
                        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    }
                })
                .catch(() => console.error('❌ Gagal memuat data kecamatan.'));
        }

        // Fungsi untuk mengupdate dropdown kelurahan
        function updateVillages(provinsi, kota, kecamatan) {
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';

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

        // --- Event Listeners ---
        provinsiSelect.addEventListener('change', function () {
            updateCities(this.value);
        });

        kabupatenSelect.addEventListener('change', function () {
            updateDistricts(provinsiSelect.value, this.value);
        });

        kecamatanSelect.addEventListener('change', function () {
            updateVillages(provinsiSelect.value, kabupatenSelect.value, this.value);
        });

        // --- Initial Load Logic (for Edit mode) ---
        // Panggil updateCities saat DOMContentLoaded jika ada selectedProv
        // Ini akan memicu rantai pemuatan berikutnya secara berurutan
        if (selectedProv) {
            updateCities(selectedProv);
        }
    });

    // Fungsi untuk toggle Periode Ngaji (tetap sama)
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

    // Jalankan saat halaman dimuat untuk mengatur status awal
    document.addEventListener('DOMContentLoaded', function() {
        toggleHalaqohPeriodStudent();
    });
</script>
@endpush