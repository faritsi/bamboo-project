// Carousel
let slideIndex = 0;
const slides = document.querySelectorAll(".carousel-slide");
const totalSlides = slides.length;
const track = document.querySelector(".carousel-track");

function showSlide(index) {
    const offset = -(index * 100) / 3; // Menggerakkan track sebesar 1/3 dari lebar setiap slide
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
