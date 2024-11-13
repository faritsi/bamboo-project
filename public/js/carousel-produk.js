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

// Function to move to the next slide
function nextSlide() {
    const itemsPerView = getItemsPerView();
    slideIndex = (slideIndex + 1) % (totalSlides - itemsPerView + 1);
    showSlide(slideIndex);
}

// Function to move to the previous slide
function prevSlide() {
    const itemsPerView = getItemsPerView();
    slideIndex =
        (slideIndex - 1 + (totalSlides - itemsPerView + 1)) %
        (totalSlides - itemsPerView + 1);
    showSlide(slideIndex);
}

// Function to start the auto-scrolling
function startAutoScroll() {
    autoScroll = setInterval(nextSlide, 5000);
}

// Function to stop the auto-scrolling
function stopAutoScroll() {
    clearInterval(autoScroll);
}

// Show the first slide on load
showSlide(slideIndex);

// Start the auto-scroll
startAutoScroll();

// Pause auto-scroll on hover and resume on mouse leave for each slide
slides.forEach((slide) => {
    slide.addEventListener("mouseenter", stopAutoScroll);
    slide.addEventListener("mouseleave", startAutoScroll);
});

// Update carousel on window resize
window.addEventListener("resize", () => showSlide(slideIndex));
