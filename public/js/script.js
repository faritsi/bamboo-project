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
