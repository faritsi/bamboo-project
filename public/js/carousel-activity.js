document.addEventListener("DOMContentLoaded", function () {
    const track = document.querySelector(".carousel-track-act");
    let index = 0;

    function moveCarousel() {
        index++;
        const slides = document.querySelectorAll(".carousel-slide-act");
        if (index >= slides.length) {
            index = 0;
        }
        track.style.transform = `translateX(-${index * 100}%)`;
    }

    setInterval(moveCarousel, 5000); // Carousel akan bergeser otomatis setiap 3 detik

    // Scroll animation to show text and carousel
    const textActivity = document.getElementById("text-activity");
    const carousel = document.querySelector(".carousel-act");

    function checkVisibility() {
        const windowHeight = window.innerHeight;
        const textTop = textActivity.getBoundingClientRect().top;
        const carouselTop = carousel.getBoundingClientRect().top;

        if (textTop < windowHeight) {
            textActivity.classList.add("visible");
        }
        if (carouselTop < windowHeight) {
            carousel.classList.add("visible");
        }
    }

    window.addEventListener("scroll", checkVisibility);
    checkVisibility(); // Untuk memastikan animasi berjalan ketika halaman dimuat
});
