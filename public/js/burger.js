document.addEventListener("DOMContentLoaded", function () {
    const burgerMenu = document.getElementById("burger-menu");
    const navbarLinks = document.querySelector(".navbar-links");

    burgerMenu.addEventListener("click", function () {
        navbarLinks.classList.toggle("show"); // Toggle class 'show' untuk menampilkan/menyembunyikan menu
    });
});
