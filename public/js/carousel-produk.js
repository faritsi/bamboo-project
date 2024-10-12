// // Carousel
// let slideIndex = 0;
// const slides = document.querySelectorAll(".carousel-slide");
// const totalSlides = slides.length;
// const track = document.querySelector(".carousel-track");

// function showSlide(index) {
//     const offset = -(index * 100) / 3; // Menggerakkan track sebesar 1/3 dari lebar setiap slide
//     track.style.transform = `translateX(${offset}%)`;
// }

// function nextSlide() {
//     slideIndex = (slideIndex + 1) % (totalSlides - 2); // Kurangi 2 karena kita menampilkan 3 produk sekaligus
//     showSlide(slideIndex);
// }

// function prevSlide() {
//     slideIndex = (slideIndex - 1 + totalSlides - 2) % (totalSlides - 2);
//     showSlide(slideIndex);
// }

// // Awal menampilkan slide pertama
// showSlide(slideIndex);

// // Geser otomatis setiap 5 detik
// setInterval(nextSlide, 5000);


// let slideIndex = 0;
// const slides = document.querySelectorAll(".carousel-slide");
// const totalSlides = slides.length;
// const track = document.querySelector(".carousel-track");
// const bullets = document.querySelectorAll(".bullet");

// function slidesToShow() {
//     if (window.innerWidth <= 768) return 1;  // 1 slide on mobile
//     if (window.innerWidth <= 1024) return 2; // 2 slides on tablet
//     return 3;  // 3 slides on desktop
// }

// function updateBullets() {
//     bullets.forEach((bullet, index) => {
//         bullet.classList.toggle('active', index === slideIndex);
//     });
// }

// function showSlide(index) {
//     const visibleSlides = slidesToShow();
//     const maxSlideIndex = totalSlides - visibleSlides;
//     slideIndex = Math.min(Math.max(index, 0), maxSlideIndex); // Bound the slide index
//     const offset = -(slideIndex * 100) / visibleSlides;
//     track.style.transform = `translateX(${offset}%)`;
//     updateBullets();
// }

// function nextSlide() {
//     showSlide(slideIndex + 1);
// }

// function prevSlide() {
//     showSlide(slideIndex - 1);
// }

// function goToSlide(index) {
//     showSlide(index);
// }

// // Awal menampilkan slide pertama
// showSlide(slideIndex);

// // Update saat resize
// window.addEventListener('resize', () => showSlide(slideIndex));
