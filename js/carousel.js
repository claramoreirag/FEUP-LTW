
let track = document.querySelector('.carousel__track');
let slides = Array.from(track.children);
let nextButton = document.querySelector('.carousel__button--right');
let prevButton = document.querySelector('.carousel__button--left');
let dotsNav = document.querySelector('.carousel__nav');
let dots = Array.from(dotsNav.children);
console.log(nextButton);
let slideWidth = window.screen.width;

const setslidePosition = (slide, index) => {
    slide.style.left = slideWidth * index + 'px';
};
slides.forEach(setslidePosition);

const moveToSlide = (track, currentSlide, targetSlide) => {
    track.style.transform = 'translateX(-' + targetSlide.style.left + ')';
    currentSlide.classList.remove('current-slide');
    targetSlide.classList.add('current-slide');
}

const updateDots = (currentDot, targetDot) => {
    currentDot.classList.remove('current-slide');
    targetDot.classList.add('current-slide');
}

// When I click left, move slides ot the left
prevButton.addEventListener('click', e => {
    // Update Arrows
    const currentSlide = track.querySelector('.current-slide');
    let prevSlide = currentSlide.previousElementSibling;
    if(prevSlide === null){
        prevSlide = slides[slides.length - 1];
    }

    // Update Dots
    const currentDot = dotsNav.querySelector('.current-slide');
    let previousDot = currentDot.previousElementSibling;
    if(previousDot === null){
        previousDot = dots[dots.length - 1];
    }

    moveToSlide(track, currentSlide, prevSlide);
    updateDots(currentDot, previousDot);
});

// When I click right, move slides to the right
nextButton.addEventListener('click', e => {
    // Update Arrows
    const currentSlide = track.querySelector('.current-slide')
    let nextSlide = currentSlide.nextElementSibling;
    if(nextSlide === null){
        nextSlide = slides[0];
    }

    // Update Dots
    const currentDot = dotsNav.querySelector('.current-slide');
    let nextDot = currentDot.nextElementSibling;
    if(nextDot === null){
        nextDot = dots[0];
    }

    moveToSlide(track, currentSlide, nextSlide);
    updateDots(currentDot, nextDot);
});


// When I click the nav indicator, move to that slide

dotsNav.addEventListener('click', e => {
    const targetDot = e.target.closest('button');
    if(!targetDot) return;

    const currentSlide = track.querySelector('.current-slide');
    const currentDot = dotsNav.querySelector('.current-slide');
    const targetSlide = slides[dots.findIndex(dot => dot === targetDot)];

    moveToSlide(track, currentSlide, targetSlide);
    updateDots(currentDot, targetDot)

})

