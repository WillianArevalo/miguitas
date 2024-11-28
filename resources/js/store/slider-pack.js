$(document).ready(function () {
    let currentSlide = 0;
    const slides = $(".slider-pack");
    const totalSlides = slides.length;
    const slider = $("#slider");
    const slideWidth = slides.outerWidth(true); // Incluye margen

    $("#prev-slider-pack").click(function () {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlider();
    });

    $("#next-slider-pack").click(function () {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlider();
    });

    function updateSlider() {
        const newTranslate = -currentSlide * slideWidth;
        slider.css("transform", `translateX(${newTranslate}px)`);
    }
});
