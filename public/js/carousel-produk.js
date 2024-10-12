let slideIndex = 0;
const slides = document.querySelectorAll(".carousel-slide");
const totalSlides = slides.length;
const track = document.querySelector(".carousel-track");

function slidesToShow() {
    // Menentukan berapa banyak slide yang ditampilkan berdasarkan lebar layar
    if (window.innerWidth <= 768) return 1;   // 1 slide di ponsel
    if (window.innerWidth <= 1024) return 2;  // 2 slide di tablet
    return 3;  // 3 slide di laptop/desktop
}

function showSlide(index) {
    const visibleSlides = slidesToShow();
    const maxSlideIndex = totalSlides - visibleSlides; // Tentukan index maksimum untuk mencegah pergeseran ke ruang kosong
    slideIndex = Math.min(index, maxSlideIndex); // Pastikan slideIndex tidak melebihi batas
    const offset = -(slideIndex * 100) / visibleSlides; // Geser track sebesar slide yang ditampilkan
    track.style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
    const visibleSlides = slidesToShow();
    if (slideIndex < totalSlides - visibleSlides) {
        slideIndex++;
    }
    showSlide(slideIndex);
}

function prevSlide() {
    if (slideIndex > 0) {
        slideIndex--;
    }
    showSlide(slideIndex);
}

// Awal menampilkan slide pertama
showSlide(slideIndex);

// Geser otomatis setiap 5 detik
setInterval(nextSlide, 5000);

// Menyesuaikan ukuran saat layar diubah
window.addEventListener('resize', () => showSlide(slideIndex));
