// Carousel JavaScript with Pause on Hover
let slideIndex = 0;
const slides = Array.from(document.querySelectorAll(".carousel-slide"));
const totalSlides = slides.length;
const track = document.querySelector(".carousel-track");
let autoScroll;

// Function to calculate the number of items per view based on window width
function getItemsPerView() {
    if (window.innerWidth >= 992) {
        return 3;
    } else if (window.innerWidth >= 768) {
        return 2;
    } else if (window.innerWidth >= 576) {
        return 2;
    } else {
        return 1;
    }
}

// Function to show the slide at the specified index
function showSlide(index) {
    const itemsPerView = getItemsPerView();
    const offset = -(index * 100) / itemsPerView;
    track.style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
    slideIndex = (slideIndex + 1) % (totalSlides - 2); // Kurangi 2 karena kita menampilkan 3 produk sekaligus
    showSlide(slideIndex);
}

function prevSlide() {
    slideIndex = (slideIndex - 1 + totalSlides - 2) % (totalSlides - 2);
    showSlide(slideIndex);
}

// Awal menampilkan slide pertama
showSlide(slideIndex);

// Geser otomatis setiap 5 detik
setInterval(nextSlide, 5000);
