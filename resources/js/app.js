import "./bootstrap";
import Swiper from "swiper";
import { Autoplay, Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";

document.addEventListener("DOMContentLoaded", function () {
    const swiperElement = document.querySelector(".swiper");
    const paginationElement = document.querySelector(
        ".swiper-custom-pagination"
    );

    if (swiperElement && paginationElement) {
        new Swiper(swiperElement, {
            modules: [Autoplay, Pagination],
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            spaceBetween: 10,
            pagination: {
                el: paginationElement, // Menggunakan pagination di luar swiper
                clickable: true,
                renderBullet: function (index, className) {
                    return `<span class="${className} custom-bullet"></span>`;
                },
            },
        });
    }
});

// category
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".category-btn").forEach((button) => {
        button.addEventListener("click", function () {
            // Hapus warna dari semua tombol
            document.querySelectorAll(".category-btn").forEach((btn) => {
                btn.classList.remove("!bg-purple", "!text-white");
                btn.classList.add("!bg-gray-100", "!text-black");
            });

            // Tambahkan warna ke tombol yang dipilih
            this.classList.add("!bg-purple", "!text-white");
            this.classList.remove("!bg-gray-100", "!text-black");

            // Simpan category_id ke hidden input
            document.getElementById("category_id").value =
                this.getAttribute("data-id");
        });
    });
});
