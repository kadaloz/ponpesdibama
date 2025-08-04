import "./bootstrap";

import Alpine from "alpinejs";
import collapse from "@alpinejs/collapse"; // ✅ Import plugin collapse
import ppdbForm from "./components/ppdb-form";
import "./components/wilayah";
import TomSelect from "tom-select";
import "tom-select/dist/css/tom-select.css";

// Register Alpine & Plugin
Alpine.plugin(collapse); // ✅ Aktifkan collapse plugin
window.Alpine = Alpine;
window.ppdbForm = ppdbForm;

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

// Wilayah (sudah di atas tapi tidak masalah redundant)
import "./components/wilayah";

// DOM Ready
document.addEventListener("DOMContentLoaded", () => {
    // Flatpickr inisialisasi
    flatpickr("#date_of_birth", {
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "d F Y",
        maxDate: new Date(new Date().setFullYear(new Date().getFullYear() - 7)),
        locale: Indonesian,
    });

    // Swiper Slider Program
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
    // ✅ TomSelect for Santri
    const santriSelect = document.querySelector("#student_id");
    if (santriSelect) {
        new TomSelect(santriSelect, {
            placeholder: "Cari santri...",
            allowEmptyOption: true,
            maxOptions: 20,
        });
    }

    // ✅ Tambahan jika ingin untuk kategori juga
    const categorySelect = document.querySelector("#category_id");
    if (categorySelect) {
        new TomSelect(categorySelect, {
            placeholder: "Pilih kategori...",
            allowEmptyOption: true,
        });
    }
});
