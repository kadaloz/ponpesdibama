import "./bootstrap";

import Alpine from "alpinejs";
window.Alpine = Alpine;
Alpine.start();

// Flatpickr
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import { Indonesian } from "flatpickr/dist/l10n/id.js";
flatpickr.localize(Indonesian);

// Swiper
import Swiper from "swiper";
import "swiper/css";
import "swiper/css/navigation";
import "swiper/css/effect-fade";

document.addEventListener("DOMContentLoaded", () => {
    // Flatpickr
    flatpickr("#date_of_birth", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        maxDate: "today",
    });

    // Swiper
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

    // DOM Select Elements
    const province = document.getElementById("province");
    const city = document.getElementById("city");
    const district = document.getElementById("district");
    const village = document.getElementById("village");

    if (!province || !city || !district || !village) return;

    const oldProv = province.dataset.old;
    const oldCity = city.dataset.old;
    const oldDistrict = district.dataset.old;
    const oldVillage = village.dataset.old;

    function setDisabled(select, disabled, loadingText = "") {
        select.disabled = disabled;
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
        setDisabled(province, true, "⏳ Memuat Provinsi...");
        fetch("/api/provinces")
            .then((res) => res.json())
            .then((data) => {
                addOptions(province, data);
                if (oldProv) {
                    province.value = oldProv;
                    loadCities(oldProv);
                }
            })
            .finally(() => (province.disabled = false));
    }

    function loadCities(prov) {
        setDisabled(city, true, "⏳ Memuat Kabupaten/Kota...");
        fetch(`/api/cities?province=${encodeURIComponent(prov)}`)
            .then((res) => res.json())
            .then((data) => {
                addOptions(city, data);
                if (oldCity) {
                    city.value = oldCity;
                    loadDistricts(prov, oldCity);
                }
            })
            .finally(() => (city.disabled = false));
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
                addOptions(district, data);
                if (oldDistrict) {
                    district.value = oldDistrict;
                    loadVillages(prov, kab, oldDistrict);
                }
            })
            .finally(() => (district.disabled = false));
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
                addOptions(village, data);
                if (oldVillage) village.value = oldVillage;
            })
            .finally(() => (village.disabled = false));
    }

    // Event Listener native select
    province.addEventListener("change", () => {
        city.innerHTML = "";
        district.innerHTML = "";
        village.innerHTML = "";
        loadCities(province.value);
    });

    city.addEventListener("change", () => {
        district.innerHTML = "";
        village.innerHTML = "";
        loadDistricts(province.value, city.value);
    });

    district.addEventListener("change", () => {
        village.innerHTML = "";
        loadVillages(province.value, city.value, district.value);
    });

    // Initial Load
    loadProvinces();
});
