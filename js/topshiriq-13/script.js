// const slider = document.querySelector('.slider');
// const slides = document.querySelectorAll('.slide');
// const prevBtn = document.querySelector('.prev-btn');
// const nextBtn = document.querySelector('.next-btn');

// let currentIndex = 0;

// function updateSlider() {
//     slides.forEach((slide, index) => {
//         slide.classList.remove('active', 'prev', 'next');
//         if (index === currentIndex) {
//             slide.classList.add('active');
//         } else if (index === (currentIndex - 1 + slides.length) % slides.length) {
//             slide.classList.add('prev');
//         } else if (index === (currentIndex + 1) % slides.length) {
//             slide.classList.add('next');
//         }
//     });
// }

// function goToPrev() {
//     currentIndex = (currentIndex - 1 + slides.length) % slides.length;
//     updateSlider();
// }

// function goToNext() {
//     currentIndex = (currentIndex + 1) % slides.length;
//     updateSlider();
// }

// updateSlider();

// prevBtn.addEventListener('click', goToPrev);
// nextBtn.addEventListener('click', goToNext);
let next = document.querySelector('.next')
let prev = document.querySelector('.prev')

next.addEventListener('click', function(){
    let items = document.querySelectorAll('.item')
    document.querySelector('.slide').appendChild(items[0])
})

prev.addEventListener('click', function(){
    let items = document.querySelectorAll('.item')
    document.querySelector('.slide').prepend(items[items.length - 1]) // here the length of items = 6
})