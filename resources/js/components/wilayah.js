document.addEventListener("DOMContentLoaded", () => {
    const provinsiSelect = document.getElementById("province");
    const kabupatenSelect = document.getElementById("city");
    const kecamatanSelect = document.getElementById("district");
    const kelurahanSelect = document.getElementById("village");

    if (
        !provinsiSelect ||
        !kabupatenSelect ||
        !kecamatanSelect ||
        !kelurahanSelect
    )
        return;

    const selectedProv = provinsiSelect.dataset.selected || "";
    const selectedKab = kabupatenSelect.dataset.selected || "";
    const selectedKec = kecamatanSelect.dataset.selected || "";
    const selectedKel = kelurahanSelect.dataset.selected || "";

    fetch("/api/provinces")
        .then((res) => res.json())
        .then((provinces) => {
            provinces.forEach((prov) => {
                provinsiSelect.appendChild(
                    new Option(prov, prov, false, prov === selectedProv)
                );
            });
            if (selectedProv) updateCities(selectedProv);
        })
        .catch(() => alert("❌ Gagal memuat data provinsi."));

    provinsiSelect.addEventListener("change", () => {
        updateCities(provinsiSelect.value);
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    });

    kabupatenSelect.addEventListener("change", () => {
        updateDistricts(provinsiSelect.value, kabupatenSelect.value);
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
    });

    kecamatanSelect.addEventListener("change", () => {
        updateVillages(
            provinsiSelect.value,
            kabupatenSelect.value,
            kecamatanSelect.value
        );
    });

    function updateCities(provinsi) {
        kabupatenSelect.innerHTML =
            '<option value="">Pilih Kabupaten/Kota</option>';
        fetch(`/api/cities?province=${encodeURIComponent(provinsi)}`)
            .then((res) => res.json())
            .then((cities) => {
                cities.forEach((kab) => {
                    kabupatenSelect.appendChild(
                        new Option(kab, kab, false, kab === selectedKab)
                    );
                });
                if (selectedKab) updateDistricts(provinsi, selectedKab);
            })
            .catch(() => alert("❌ Gagal memuat data kota/kabupaten."));
    }

    function updateDistricts(provinsi, kota) {
        kecamatanSelect.innerHTML = '<option value="">Pilih Kecamatan</option>';
        fetch(
            `/api/districts?province=${encodeURIComponent(
                provinsi
            )}&city=${encodeURIComponent(kota)}`
        )
            .then((res) => res.json())
            .then((districts) => {
                districts.forEach((kec) => {
                    kecamatanSelect.appendChild(
                        new Option(kec, kec, false, kec === selectedKec)
                    );
                });

                const found = Array.from(kecamatanSelect.options).some(
                    (opt) => opt.value === selectedKec
                );
                if (!found) {
                    kecamatanSelect.dispatchEvent(new Event("change"));
                } else {
                    updateVillages(provinsi, kota, selectedKec);
                }
            })
            .catch(() => alert("❌ Gagal memuat data kecamatan."));
    }

    function updateVillages(provinsi, kota, kecamatan) {
        kelurahanSelect.innerHTML = '<option value="">Pilih Kelurahan</option>';
        fetch(
            `/api/villages?province=${encodeURIComponent(
                provinsi
            )}&city=${encodeURIComponent(kota)}&district=${encodeURIComponent(
                kecamatan
            )}`
        )
            .then((res) => res.json())
            .then((villages) => {
                villages.forEach((kel) => {
                    kelurahanSelect.appendChild(
                        new Option(kel, kel, false, kel === selectedKel)
                    );
                });
            })
            .catch(() => alert("❌ Gagal memuat data kelurahan."));
    }
});
