import "./bootstrap";
import Swiper from "swiper";
import { Autoplay, Pagination } from "swiper/modules";
import "swiper/css";
import "swiper/css/pagination";
import Swal from "sweetalert2";
import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

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

// File upload handling for all forms
document.addEventListener("DOMContentLoaded", function () {
    const fileInput = document.getElementById("photo");
    const fileChosen = document.getElementById("file-chosen");
    const fileInputLabel = document.getElementById("upload-label");

    if (fileInput && fileChosen) {
        fileInput.addEventListener("change", function () {
            if (fileInput.files.length > 0) {
                fileInputLabel.classList.add("!bg-purple");
                fileInputLabel.classList.add("!text-white");
                fileChosen.textContent = fileInput.files[0].name;
            } else {
                fileInputLabel.classList.remove("!bg-purple");
                fileInputLabel.classList.remove("!text-white");
                fileChosen.textContent = "Tidak ada file dipilih";
            }
        });
    }

    // Category selection
    const categoryButtons = document.querySelectorAll(".select-category-btn");
    const categoryIdInput = document.getElementById("category_id");

    if (categoryButtons.length > 0 && categoryIdInput) {
        categoryButtons.forEach((button) => {
            button.addEventListener("click", function () {
                // Reset all buttons to default state
                categoryButtons.forEach((btn) => {
                    btn.classList.remove("!bg-purple");
                    btn.classList.remove("!text-white");
                });

                // Set this button as selected
                this.classList.add("!bg-purple");
                this.classList.add("!text-white");

                // Update hidden input with selected category ID
                categoryIdInput.value = this.getAttribute("data-id");
            });
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

// search icon for submit
document.addEventListener("DOMContentLoaded", function () {
    const searchIcon = document.getElementById("search-icon");
    const form = document.querySelector("form");
    const searchInput = document.getElementById("search");

    if (searchIcon && searchInput) {
        if (searchInput.value) {
            searchIcon.addEventListener("click", function () {
                form.submit();
            });
        }
    }
});
