document.getElementById("burger-menu").addEventListener("click", function () {
    const burgerMenuList = document.getElementById("burgerMenuList");
    const burgerMenuIcon = document.getElementById("burger-menu");
    const burgerIcon = document.getElementById("burger-icon");

    // Toggle menu visibility
    burgerMenuList.classList.toggle("show");

    // Toggle icon between burger and "X" and position as fixed for "X"
    if (burgerMenuList.classList.contains("show")) {
        burgerIcon.innerHTML = "&#10005;"; // Icon "X"
        burgerMenuIcon.classList.add("fixed"); // Add fixed position to icon "X"
    } else {
        burgerIcon.innerHTML = "&#9776;"; // Icon burger
        burgerMenuIcon.classList.remove("fixed"); // Remove fixed position
    }
});
