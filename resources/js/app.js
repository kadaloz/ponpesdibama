function setLoading(select, loadingText = "") {
    select.innerHTML = "";
    if (loadingText) {
        const option = document.createElement("option");
        option.text = loadingText;
        option.value = "";
        select.appendChild(option);
    }
}

function addOptions(select, items) {
    select.innerHTML = "";
    const defaultOpt = document.createElement("option");
    defaultOpt.text = "-- Pilih --";
    defaultOpt.value = "";
    select.appendChild(defaultOpt);

    items.forEach((item) => {
        const option = document.createElement("option");
        option.text = item;
        option.value = item;
        select.appendChild(option);
    });
}

function loadProvinces() {
    setLoading(province, "⏳ Memuat Provinsi...");
    fetch("/api/provinces")
        .then((res) => res.json())
        .then((data) => {
            addOptions(province, data);
            if (oldProv) {
                province.value = oldProv;
                loadCities(oldProv);
            }
        });
}

function loadCities(prov) {
    setLoading(city, "⏳ Memuat Kabupaten/Kota...");
    fetch(`/api/cities?province=${encodeURIComponent(prov)}`)
        .then((res) => res.json())
        .then((data) => {
            addOptions(city, data);
            if (oldCity) {
                city.value = oldCity;
                loadDistricts(prov, oldCity);
            }
        })
        .catch((err) => {
            console.error("❌ Gagal memuat kota:", err);
        });
}

function loadDistricts(prov, kab) {
    setLoading(district, "⏳ Memuat Kecamatan...");
    fetch(
        `/api/districts?province=${encodeURIComponent(
            prov
        )}&city=${encodeURIComponent(kab)}`
    )
        .then((res) => res.json())
        .then((data) => {
            addOptions(district, data);
            if (oldDistrict) {
                district.value = oldDistrict;
                loadVillages(prov, kab, oldDistrict);
            }
        });
}

function loadVillages(prov, kab, kec) {
    setLoading(village, "⏳ Memuat Kelurahan...");
    fetch(
        `/api/villages?province=${encodeURIComponent(
            prov
        )}&city=${encodeURIComponent(kab)}&district=${encodeURIComponent(kec)}`
    )
        .then((res) => res.json())
        .then((data) => {
            addOptions(village, data);
            if (oldVillage) village.value = oldVillage;
        });
}
