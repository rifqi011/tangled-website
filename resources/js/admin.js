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
        })

        window.addEventListener("click", function (event) {
            if (
                !sidebar.contains(event.target) &&
                !sidebarButton.contains(event.target)
            ) {
                sidebar.classList.add("-translate-x-full");
            }
        });
    }
});
