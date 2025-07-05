import './bootstrap';

import Alpine from 'alpinejs';
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
        maxDate: "today"
    });
});

import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

// Inisialisasi saat DOM siap
document.addEventListener("DOMContentLoaded", function () {
    const province = document.getElementById("province");
    const city = document.getElementById("city");

    if (province) {
        const tsProvince = new TomSelect(province, {
            placeholder: "Pilih Provinsi...",
            maxOptions: 1000
        });

        const tsCity = new TomSelect(city, {
            placeholder: "Pilih Kabupaten/Kota...",
            maxOptions: 1000
        });

        fetch("/api/provinces")
            .then((res) => res.json())
            .then((data) => {
                data.forEach((prov) => tsProvince.addOption({ value: prov, text: prov }));
                tsProvince.refreshOptions();
            });

        tsProvince.on("change", function (value) {
            tsCity.clearOptions();
            tsCity.setValue("");

            if (value) {
                fetch(`/api/cities?province=${encodeURIComponent(value)}`)
                    .then((res) => res.json())
                    .then((data) => {
                        data.forEach((city) => tsCity.addOption({ value: city, text: city }));
                        tsCity.refreshOptions();
                    });
            }
        });
    }
});

import Swiper from 'swiper';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/effect-fade';

document.addEventListener('DOMContentLoaded', () => {
    const swiperEl = document.querySelector('.programSwiper');

    if (swiperEl) {
        new Swiper(swiperEl, {
            loop: true,
            effect: 'fade',
            fadeEffect: { crossFade: true },
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            slidesPerView: 1,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    }
});





