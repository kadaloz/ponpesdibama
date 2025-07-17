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
        // Pastikan nilai ini sudah di-trim untuk menghindari spasi ekstra
        const selectedProv = "{{ old('province', $student->province ?? '') }}".trim();
        const selectedKab = "{{ old('city', $student->city ?? '') }}".trim();
        const selectedKec = "{{ old('district', $student->district ?? '') }}".trim();
        const selectedKel = "{{ old('village', $student->village ?? '') }}".trim();

        // Fungsi untuk mengupdate dropdown provinsi
        function updateProvinces() {
            provinsiSelect.innerHTML = '<option value="">Memuat Provinsi...</option>';
            fetch(`/api/provinces`)
                .then(res => res.json())
                .then(provinces => {
                    provinsiSelect.innerHTML = '<option value="">Pilih Provinsi</option>'; // Default option
                    let provinceFoundAndSelected = false;

                    provinces.forEach(prov => {
                        // Pastikan perbandingan juga di-trim
                        const trimmedProv = prov.trim();
                        const isSelected = (trimmedProv === selectedProv);
                        const option = new Option(trimmedProv, trimmedProv, false, isSelected);
                        provinsiSelect.appendChild(option);
                        if (isSelected) {
                            provinceFoundAndSelected = true;
                        }
                    });

                    // PENTING: Jika ada selectedProv DAN berhasil ditemukan & dipilih di dropdown
                    // Maka panggil updateCities untuk mengisi dropdown selanjutnya
                    if (provinceFoundAndSelected) {
                        updateCities(selectedProv);
                    } else {
                        // Jika tidak ada selectedProv atau tidak cocok, pastikan dropdown bawah bersih
                        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    }
                })
                .catch(error => {
                    console.error('❌ Gagal memuat data provinsi:', error);
                    provinsiSelect.innerHTML = '<option value="">Gagal memuat Provinsi</option>';
                });
        }

        // Fungsi untuk mengupdate dropdown kota/kabupaten
        function updateCities(provinsi) {
            kabupatenSelect.innerHTML = '<option value="">Memuat Kabupaten/Kota...</option>';
            kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>'; // Clear lower levels
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>'; // Clear lower levels

            if (!provinsi) {
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                return;
            }

            fetch(`/api/cities?province=${encodeURIComponent(provinsi)}`)
                .then(res => res.json())
                .then(cities => {
                    kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
                    let cityFoundAndSelected = false;

                    cities.forEach(kab => {
                        const trimmedKab = kab.trim();
                        const isSelected = (trimmedKab === selectedKab);
                        const option = new Option(trimmedKab, trimmedKab, false, isSelected);
                        kabupatenSelect.appendChild(option);
                        if (isSelected) {
                            cityFoundAndSelected = true;
                        }
                    });

                    if (cityFoundAndSelected) {
                        updateDistricts(provinsi, selectedKab);
                    } else {
                        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    }
                })
                .catch(error => {
                    console.error('❌ Gagal memuat data kota/kabupaten:', error);
                    kabupatenSelect.innerHTML = '<option value="">Gagal memuat Kabupaten/Kota</option>';
                });
        }

        // Fungsi untuk mengupdate dropdown kecamatan
        function updateDistricts(provinsi, kota) {
            kecamatanSelect.innerHTML = '<option value="">Memuat Kecamatan...</option>';
            kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>'; // Clear lower level

            if (!provinsi || !kota) {
                kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                return;
            }

            fetch(`/api/districts?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}`)
                .then(res => res.json())
                .then(districts => {
                    kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
                    let districtFoundAndSelected = false;

                    districts.forEach(kec => {
                        const trimmedKec = kec.trim();
                        const isSelected = (trimmedKec === selectedKec);
                        const option = new Option(trimmedKec, trimmedKec, false, isSelected);
                        kecamatanSelect.appendChild(option);
                        if (isSelected) {
                            districtFoundAndSelected = true;
                        }
                    });

                    if (districtFoundAndSelected) {
                        updateVillages(provinsi, kota, selectedKec);
                    } else {
                         kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
                    }
                })
                .catch(error => {
                    console.error('❌ Gagal memuat data kecamatan:', error);
                    kecamatanSelect.innerHTML = '<option value="">Gagal memuat Kecamatan</option>';
                });
        }

        // Fungsi untuk mengupdate dropdown kelurahan
        function updateVillages(provinsi, kota, kecamatan) {
            kelurahanSelect.innerHTML = '<option value="">Memuat Kelurahan/Desa...</option>';

            if (!provinsi || !kota || !kecamatan) {
                kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                return;
            }

            fetch(`/api/villages?province=${encodeURIComponent(provinsi)}&city=${encodeURIComponent(kota)}&district=${encodeURIComponent(kecamatan)}`)
                .then(res => res.json())
                .then(villages => {
                    kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan/Desa</option>';
                    villages.forEach(kel => {
                        const trimmedKel = kel.trim();
                        const option = new Option(trimmedKel, trimmedKel, false, trimmedKel === selectedKel);
                        kelurahanSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('❌ Gagal memuat data kelurahan:', error);
                    kelurahanSelect.innerHTML = '<option value="">Gagal memuat Kelurahan/Desa</option>';
                });
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

        // --- Initial Load Logic ---
        // Panggil updateProvinces saat DOMContentLoaded.
        updateProvinces();
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