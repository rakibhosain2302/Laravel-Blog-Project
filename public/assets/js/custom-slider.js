document.addEventListener('DOMContentLoaded', function () {
    var slider = document.getElementById('customSlider');
    if (!slider) return;

    var slides = Array.prototype.slice.call(slider.querySelectorAll('.slide'));
    var prevBtn = slider.querySelector('.slider-control.prev');
    var nextBtn = slider.querySelector('.slider-control.next');
    var indicators = Array.prototype.slice.call(slider.querySelectorAll('.slider-indicators .indicator'));
    var currentIndex = 0;
    var intervalDuration = 5000;
    var timer = null;

    function goToSlide(index) {
        if (!slides.length) return;
        if (index < 0) index = slides.length - 1;
        if (index >= slides.length) index = 0;

        slides.forEach(function (slide, idx) {
            slide.classList.toggle('active', idx === index);
        });

        indicators.forEach(function (indicator, idx) {
            indicator.classList.toggle('active', idx === index);
        });

        currentIndex = index;
    }

    function nextSlide() {
        goToSlide(currentIndex + 1);
    }

    function startTimer() {
        stopTimer();
        timer = window.setInterval(nextSlide, intervalDuration);
    }

    function stopTimer() {
        if (timer !== null) {
            window.clearInterval(timer);
            timer = null;
        }
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            goToSlide(currentIndex - 1);
            startTimer();
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            nextSlide();
            startTimer();
        });
    }

    indicators.forEach(function (indicator, index) {
        indicator.addEventListener('click', function () {
            goToSlide(index);
            startTimer();
        });
    });

    if (slides.length > 1) {
        startTimer();
    }
});
