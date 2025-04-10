import "./bootstrap";
import Swiper from "swiper";
import { Autoplay, Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";
import Swal from "sweetalert2";

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

// select category
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".select-category-btn").forEach((button) => {
        button.addEventListener("click", function () {
            // Hapus warna dari semua tombol
            document.querySelectorAll(".select-category-btn").forEach((btn) => {
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

// picture upload label
document.addEventListener("DOMContentLoaded", function () {
    const photoInput = document.getElementById("photo");
    const uploadLabel = document.getElementById("upload-label");
    const fileChosen = document.getElementById("file-chosen");

    if (photoInput && uploadLabel && fileChosen) {
        photoInput.addEventListener("change", function () {
            if (photoInput.value) {
                uploadLabel.textContent = "Gambar Terunggah";
                uploadLabel.classList.add("bg-purple");
                uploadLabel.classList.remove("bg-black");

                if (this.files && this.files.length > 0) {
                    fileChosen.textContent = this.files[0].name;
                } else {
                    fileChosen.textContent = "Tidak ada file dipilih";
                }
            } else {
                uploadLabel.textContent = "Upload Gambar";
                uploadLabel.classList.add("bg-black");
                uploadLabel.classList.remove("bg-purple");
            }
        });
    }
});

// telephone input
document.addEventListener("DOMContentLoaded", function () {
    const phoneInput = document.getElementById("userphone");

    if (phoneInput) {
        phoneInput.addEventListener("input", function () {
            if (!this.value.startsWith("62")) {
                this.value = "62" + this.value;
            }
        });

        phoneInput.addEventListener("keydown", function (event) {
            if (
                (event.key === "Backspace" || event.key === "Delete") &&
                this.value.length <= 2
            ) {
                event.preventDefault();
            }
        });
    }
});

// filter modal
const filterButton = document.getElementById("filter-button");

if (filterButton) {
    filterButton.addEventListener("click", function () {
        const topBar = document.getElementById("top-bar");
        const middleBar = document.getElementById("middle-bar");
        const bottomBar = document.getElementById("bottom-bar");

        const filterModal = document.getElementById("filter-modal");
        filterModal.classList.toggle("-translate-y-[160%]");

        topBar.classList.toggle("rotate-45");
        topBar.classList.toggle("translate-y-[10px]");
        topBar.classList.toggle("!w-10");

        middleBar.classList.toggle("opacity-0");

        bottomBar.classList.toggle("-rotate-45");
        bottomBar.classList.toggle("-translate-y-[10px]");
        bottomBar.classList.toggle("!w-10");
    });
}

// categories in search modal
document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const categoryButtons = document.querySelectorAll(".category-btn");
    const categoryInput = document.getElementById("category_id");

    categoryButtons.forEach((button) => {
        button.addEventListener("click", function () {
            // Remove active state from all buttons
            categoryButtons.forEach((btn) => {
                btn.classList.remove("!bg-purple", "!text-white");
                btn.classList.add("!bg-gray-100", "!text-black");
            });

            // Add active state to clicked button
            this.classList.add("!bg-purple", "!text-white");
            this.classList.remove("!bg-gray-100", "!text-black");

            // Update hidden input
            categoryInput.value = this.getAttribute("data-id");

            // Submit form
            form.submit();
        });
    });
});

// SweetAlert2
window.Swal = Swal;
