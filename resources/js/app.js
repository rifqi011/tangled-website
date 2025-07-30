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

// Enhanced filter modal functionality
document.addEventListener("DOMContentLoaded", function () {
    const filterButton = document.getElementById("filter-button");

    if (filterButton) {
        filterButton.addEventListener("click", function () {
            const topBar = document.getElementById("top-bar");
            const middleBar = document.getElementById("middle-bar");
            const bottomBar = document.getElementById("bottom-bar");
            const filterModal = document.getElementById("filter-modal");

            // Toggle modal visibility
            filterModal.classList.toggle("-translate-y-[160%]");
            filterModal.classList.toggle("lg:hidden");

            // Animate hamburger to X
            topBar.classList.toggle("rotate-45");
            topBar.classList.toggle("translate-y-[10px]");
            topBar.classList.toggle("!w-10");

            middleBar.classList.toggle("opacity-0");

            bottomBar.classList.toggle("-rotate-45");
            bottomBar.classList.toggle("-translate-y-[10px]");
            bottomBar.classList.toggle("!w-10");
        });
    }

    // Enhanced search filter functionality - FIXED VERSION
    const searchForm = document.getElementById("search-form");

    if (searchForm) {
        // Initialize filter state variables with current values from server
        let currentCategory =
            document.getElementById("category_id")?.value || "Semua";
        let currentItemType =
            document.getElementById("item_type_id")?.value || "Semua";
        let currentStartDate =
            document.getElementById("start_date_id")?.value || "";
        let currentEndDate =
            document.getElementById("end_date_id")?.value || "";

        // Category filter buttons
        const categoryButtons = document.querySelectorAll(".category-btn");
        const categoryInput = document.getElementById("category_id");

        if (categoryButtons.length > 0) {
            categoryButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    // Remove active state from all category buttons
                    categoryButtons.forEach((btn) => {
                        btn.classList.remove("!bg-purple", "!text-white");
                        btn.classList.add("!bg-gray-100", "!text-black");
                    });

                    // Add active state to clicked button
                    this.classList.add("!bg-purple", "!text-white");
                    this.classList.remove("!bg-gray-100", "!text-black");

                    // Update current selection
                    currentCategory = this.getAttribute("data-id");
                });
            });
        }

        // Item type filter buttons
        const itemTypeButtons = document.querySelectorAll(".item-type-btn");
        const itemTypeInput = document.getElementById("item_type_id");

        if (itemTypeButtons.length > 0) {
            itemTypeButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    // Remove active state from all item type buttons
                    itemTypeButtons.forEach((btn) => {
                        btn.classList.remove("!bg-purple", "!text-white");
                        btn.classList.add("!bg-gray-100", "!text-black");
                    });

                    // Add active state to clicked button
                    this.classList.add("!bg-purple", "!text-white");
                    this.classList.remove("!bg-gray-100", "!text-black");

                    // Update current selection
                    currentItemType = this.getAttribute("data-type");
                });
            });
        }

        // Date range filter functionality
        const startDateInput = document.getElementById("start_date");
        const endDateInput = document.getElementById("end_date");
        const startDateHidden = document.getElementById("start_date_id");
        const endDateHidden = document.getElementById("end_date_id");
        const clearDatesBtn = document.getElementById("clear-dates");
        const applyFiltersBtn = document.getElementById("apply-filters");

        // Update current selections when date inputs change
        if (startDateInput) {
            startDateInput.addEventListener("change", function () {
                currentStartDate = this.value;
            });
        }

        if (endDateInput) {
            endDateInput.addEventListener("change", function () {
                currentEndDate = this.value;
            });
        }

        // Clear/Reset all filters functionality
        if (clearDatesBtn) {
            clearDatesBtn.addEventListener("click", function () {
                // Reset all current selections
                currentCategory = "Semua";
                currentItemType = "Semua";
                currentStartDate = "";
                currentEndDate = "";

                // Clear date inputs
                if (startDateInput) startDateInput.value = "";
                if (endDateInput) endDateInput.value = "";

                // Clear search input
                const searchInput = document.getElementById("search");
                if (searchInput) searchInput.value = "";

                // Reset visual state of all filter buttons
                categoryButtons.forEach((btn) => {
                    btn.classList.remove("!bg-purple", "!text-white");
                    btn.classList.add("!bg-gray-100", "!text-black");
                });

                itemTypeButtons.forEach((btn) => {
                    btn.classList.remove("!bg-purple", "!text-white");
                    btn.classList.add("!bg-gray-100", "!text-black");
                });

                // Set default active states (Semua)
                const defaultCategoryBtn = document.querySelector(
                    '.category-btn[data-id="Semua"]'
                );
                const defaultItemTypeBtn = document.querySelector(
                    '.item-type-btn[data-type="Semua"]'
                );

                if (defaultCategoryBtn) {
                    defaultCategoryBtn.classList.add(
                        "!bg-purple",
                        "!text-white"
                    );
                    defaultCategoryBtn.classList.remove(
                        "!bg-gray-100",
                        "!text-black"
                    );
                }

                if (defaultItemTypeBtn) {
                    defaultItemTypeBtn.classList.add(
                        "!bg-purple",
                        "!text-white"
                    );
                    defaultItemTypeBtn.classList.remove(
                        "!bg-gray-100",
                        "!text-black"
                    );
                }

                // Update hidden inputs and submit
                if (categoryInput) categoryInput.value = "Semua";
                if (itemTypeInput) itemTypeInput.value = "Semua";
                if (startDateHidden) startDateHidden.value = "";
                if (endDateHidden) endDateHidden.value = "";

                // Submit form to apply reset
                searchForm.submit();
            });
        }

        // Apply filters functionality
        if (applyFiltersBtn) {
            applyFiltersBtn.addEventListener("click", function () {
                // Update all hidden inputs with current selections
                if (categoryInput) {
                    categoryInput.value = currentCategory;
                }

                if (itemTypeInput) {
                    itemTypeInput.value = currentItemType;
                }

                if (startDateHidden) {
                    startDateHidden.value = currentStartDate;
                }

                if (endDateHidden) {
                    endDateHidden.value = currentEndDate;
                }

                // Submit form with all current filters
                searchForm.submit();
            });
        }

        // Search input - submit on Enter key or search icon click
        const searchInput = document.getElementById("search");
        if (searchInput) {
            searchInput.addEventListener("keypress", function (event) {
                if (event.key === "Enter") {
                    // Update hidden inputs before submitting
                    if (categoryInput) categoryInput.value = currentCategory;
                    if (itemTypeInput) itemTypeInput.value = currentItemType;
                    if (startDateHidden)
                        startDateHidden.value = currentStartDate;
                    if (endDateHidden) endDateHidden.value = currentEndDate;

                    searchForm.submit();
                }
            });
        }
    }
});

// SweetAlert2
window.Swal = Swal;

// search icon for submit
document.addEventListener("DOMContentLoaded", function () {
    const searchIcon = document.getElementById("search-icon");
    const searchForm = document.getElementById("search-form");
    const searchInput = document.getElementById("search");

    if (searchIcon && searchForm) {
        searchIcon.addEventListener("click", function () {
            // Get current filter values before submitting
            const categoryInput = document.getElementById("category_id");
            const itemTypeInput = document.getElementById("item_type_id");
            const startDateInput = document.getElementById("start_date");
            const endDateInput = document.getElementById("end_date");
            const startDateHidden = document.getElementById("start_date_id");
            const endDateHidden = document.getElementById("end_date_id");

            // Update hidden inputs with current filter selections
            if (categoryInput && window.currentCategory) {
                categoryInput.value = window.currentCategory;
            }
            if (itemTypeInput && window.currentItemType) {
                itemTypeInput.value = window.currentItemType;
            }
            if (startDateInput && startDateHidden) {
                startDateHidden.value = startDateInput.value;
            }
            if (endDateInput && endDateHidden) {
                endDateHidden.value = endDateInput.value;
            }

            searchForm.submit();
        });
    }
});
