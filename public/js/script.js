let currentSlide = 0;

function showSlide(index) {
    const slides = document.querySelectorAll(".client");
    const totalSlides = slides.length / 2; // Show two slides at a time
    if (index >= totalSlides) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = totalSlides - 1;
    } else {
        currentSlide = index;
    }
    const offset = -currentSlide * 50; // Move by 50% for each set of two slides
    document.querySelector(
        ".bungkus-client"
    ).style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

document.addEventListener("DOMContentLoaded", () => {
    showSlide(currentSlide);
    setInterval(nextSlide, 3000); // Change slide every 3 seconds
});

function triggerTable(number, element) {
    // Hide all extra-info rows first
    var rows = document.querySelectorAll(".extra-info-1, .extra-info-2");
    rows.forEach(function (row) {
        row.style.display = "none";
    });

    // Determine which row to show based on the number
    var rowClass = ".extra-info-" + number;
    var row = element.closest("tr").nextElementSibling;

    while (row && !row.classList.contains(rowClass.substring(1))) {
        row = row.nextElementSibling;
    }

    if (row) {
        row.style.display = "table-row";
    }
}
// function previewImage() {
//     const image = document.querySelector("#image");
//     const imgPreview = document.querySelector(".img-preview");

//     if (image.files && image.files[0]) {
//         const oFReader = new FileReader();
//         oFReader.readAsDataURL(image.files[0]);

//         oFReader.onload = function (oFREvent) {
//             imgPreview.src = oFREvent.target.result;
//         };
//     }
// }
