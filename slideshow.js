document.addEventListener("DOMContentLoaded", function () {

    const slides = document.querySelectorAll("#slideShowImages img");

    let currentSlide = 0;

    // Sabhi images ko hide karo
    slides.forEach(function (slide) {
        slide.style.display = "none";
    });

    // Pehli image show karo
    if (slides.length > 0) {
        slides[0].style.display = "block";
    }

    // Har 3 second me next image
    setInterval(function () {

        slides[currentSlide].style.display = "none";

        currentSlide++;

        if (currentSlide >= slides.length) {
            currentSlide = 0;
        }

        slides[currentSlide].style.display = "block";

    }, 3000);

});