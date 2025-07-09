import "./bootstrap";

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

// ⬇️ Tambahkan Flatpickr setelah Alpine
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";

// Opsional: Bahasa Indonesia
import { Indonesian } from "flatpickr/dist/l10n/id.js";
flatpickr.localize(Indonesian);

// Inisialisasi setelah DOM siap
document.addEventListener("DOMContentLoaded", function () {
    flatpickr("#date_of_birth", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        maxDate: "today",
    });
});

import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

// Inisialisasi saat DOM siap
document.addEventListener("DOMContentLoaded", function () {
    const province = document.getElementById("province");
    const city = document.getElementById("city");
    const district = document.getElementById("district");
    const village = document.getElementById("village");

    const oldProv = province.dataset.old;
    const oldCity = city.dataset.old;
    const oldDistrict = district.dataset.old;
    const oldVillage = village.dataset.old;

    const tsProvince = new TomSelect(province, {
        placeholder: "Pilih Provinsi",
        maxOptions: 1000,
    });
    const tsCity = new TomSelect(city, {
        placeholder: "Pilih Kabupaten/Kota",
        maxOptions: 1000,
    });
    const tsDistrict = new TomSelect(district, {
        placeholder: "Pilih Kecamatan",
        maxOptions: 1000,
    });
    const tsVillage = new TomSelect(village, {
        placeholder: "Pilih Kelurahan/Desa",
        maxOptions: 1000,
    });

    function setDisabled(select, disabled, loadingText = "") {
        select.disabled = disabled;
        const tom = TomSelect.instances.get(select);
        tom.clearOptions();
        if (loadingText) {
            tom.addOption({ value: "", text: loadingText });
            tom.refreshOptions();
        }
    }

    function loadProvinces() {
        setDisabled(province, true, "⏳ Memuat Provinsi...");
        fetch("/api/provinces")
            .then((res) => res.json())
            .then((data) => {
                data.forEach((prov) =>
                    tsProvince.addOption({ value: prov, text: prov })
                );
                tsProvince.refreshOptions();
                if (oldProv) {
                    tsProvince.setValue(oldProv);
                    loadCities(oldProv);
                }
            })
            .finally(() => setDisabled(province, false));
    }

    function loadCities(prov) {
        setDisabled(city, true, "⏳ Memuat Kabupaten/Kota...");
        fetch(`/api/cities?province=${encodeURIComponent(prov)}`)
            .then((res) => res.json())
            .then((data) => {
                data.forEach((kab) =>
                    tsCity.addOption({ value: kab, text: kab })
                );
                tsCity.refreshOptions();
                if (oldCity) {
                    tsCity.setValue(oldCity);
                    loadDistricts(prov, oldCity);
                }
            })
            .finally(() => setDisabled(city, false));
    }

    function loadDistricts(prov, kab) {
        setDisabled(district, true, "⏳ Memuat Kecamatan...");
        fetch(
            `/api/districts?province=${encodeURIComponent(
                prov
            )}&city=${encodeURIComponent(kab)}`
        )
            .then((res) => res.json())
            .then((data) => {
                data.forEach((kec) =>
                    tsDistrict.addOption({ value: kec, text: kec })
                );
                tsDistrict.refreshOptions();
                if (oldDistrict) {
                    tsDistrict.setValue(oldDistrict);
                    loadVillages(prov, kab, oldDistrict);
                }
            })
            .finally(() => setDisabled(district, false));
    }

    function loadVillages(prov, kab, kec) {
        setDisabled(village, true, "⏳ Memuat Kelurahan...");
        fetch(
            `/api/villages?province=${encodeURIComponent(
                prov
            )}&city=${encodeURIComponent(kab)}&district=${encodeURIComponent(
                kec
            )}`
        )
            .then((res) => res.json())
            .then((data) => {
                data.forEach((kel) =>
                    tsVillage.addOption({ value: kel, text: kel })
                );
                tsVillage.refreshOptions();
                if (oldVillage) tsVillage.setValue(oldVillage);
            })
            .finally(() => setDisabled(village, false));
    }

    // Trigger perubahan manual
    tsProvince.on("change", (value) => {
        tsCity.clearOptions();
        tsCity.setValue("");
        tsDistrict.clearOptions();
        tsDistrict.setValue("");
        tsVillage.clearOptions();
        tsVillage.setValue("");
        loadCities(value);
    });

    tsCity.on("change", (value) => {
        tsDistrict.clearOptions();
        tsDistrict.setValue("");
        tsVillage.clearOptions();
        tsVillage.setValue("");
        loadDistricts(tsProvince.getValue(), value);
    });

    tsDistrict.on("change", (value) => {
        tsVillage.clearOptions();
        tsVillage.setValue("");
        loadVillages(tsProvince.getValue(), tsCity.getValue(), value);
    });

    // Initial load
    loadProvinces();
});

import Swiper from "swiper";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/effect-fade";

document.addEventListener("DOMContentLoaded", () => {
    const swiperEl = document.querySelector(".programSwiper");

    if (swiperEl) {
        new Swiper(swiperEl, {
            loop: true,
            effect: "fade",
            fadeEffect: { crossFade: true },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            slidesPerView: 1,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
    }
});
