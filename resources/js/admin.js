document.addEventListener("DOMContentLoaded", function () {
    const sidebarButton = document.getElementById("sidebar-button");
    const sidebar = document.getElementById("sidebar");
    const closeSidebarButton = document.getElementById("close-sidebar");

    if (sidebarButton && sidebar && closeSidebarButton) {
        sidebarButton.addEventListener("click", function () {
            sidebar.classList.remove("-translate-x-full");
        });

        closeSidebarButton.addEventListener("click", function () {
            sidebar.classList.add("-translate-x-full");
        });

        window.addEventListener("click", function (event) {
            if (
                !sidebar.contains(event.target) &&
                !sidebarButton.contains(event.target)
            ) {
                sidebar.classList.add("-translate-x-full");
            }
        });
    }

    // Menu user in mobile view
    const userButton = document.getElementById("user-button");
    const userDropdown = document.getElementById("user-dropdown")

    if (userButton && userDropdown) {
        userButton.addEventListener("click", function () {
            userDropdown.classList.toggle("translate-x-[120%]");
        });

        window.addEventListener("click", function (event) {
            if (!userDropdown.contains(event.target) && !userButton.contains(event.target)) {
                userDropdown.classList.add("translate-x-[120%]");
            }
        })
    }
});
