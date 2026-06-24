const banners = document.querySelectorAll(".banner");
const nextBtn = document.querySelector("#nextBtn");
const prevBtn = document.querySelector("#prevBtn");
const circles = document.querySelectorAll(".circle");
const bannersWrap = document.querySelector(".slider");

let indexBanner = 1;
let indexCircle = 0;
let timerSlider;
let isMoving = false; // Защита от бешеных кликов во время анимации

banners[indexBanner].classList.add("active");

// Сразу смещаем слайдер на первый настоящий слайд БЕЗ анимации
bannersWrap.style.transition = 'none';
bannersWrap.style.transform = `translateX(-100vw)`;

startSlider();
freezeSlider();
unfreezeSlider();



nextBtn.addEventListener("click", () =>
  { 
    if (isMoving) return;
      isMoving = true;
    nextSlide();
    })

prevBtn.addEventListener("click", () =>
  {
    if (isMoving) return;
      isMoving = true;
    prevSlide();
  })


circles.forEach((circle, i) => { 

if (isMoving) return;
  circle.addEventListener("click", () =>
    {
      updateCircles();
      bannersWrap.style.transition = 'transform 0.5s ease-in-out';
      bannersWrap.style.transform = `translateX(${(-i - 1) * 100}vw)`;
      indexBanner = i + 1;
      startSlider();
      updateCircles();
    })
})

function nextSlide()        // переклю. на следующий слайд (для кнопки)
{

    indexBanner++;
    if (indexBanner == banners.length) indexBanner = 0;
    bannersWrap.style.transition = 'transform 0.5s ease-in-out';
    bannersWrap.style.transform = `translateX(${-indexBanner * 100}vw)`;
    updateCircles();
    startSlider();
}

function updateCircles() {
    circles.forEach(circle => circle.classList.remove('circleActive'));
    
    let circleIndex = indexBanner - 1;
    if (indexBanner === 4) circleIndex = 0; // Если мы на правом клоне -> это 1-й слайд
    if (indexBanner === 0) circleIndex = 2; // Если мы на левом клоне -> это 3-й слайд
    
    circles[circleIndex].classList.add('circleActive');
}


function prevSlide()      {   // переклю. на предыдущий слайд (для кнопки)


    indexBanner--;
    if (indexBanner == -1) indexBanner = banners.length - 1;
    bannersWrap.style.transition = 'transform 0.5s ease-in-out';
    bannersWrap.style.transform = `translateX(${-indexBanner * 100}vw)`;
    updateCircles();
    startSlider();
}

// Функция переноса с Клонов на Оригинальные слайды

bannersWrap.addEventListener('transitionend', () => {

    isMoving = false;
    
    // Если долетели до правого клона (копия 1-го слайда)
    if (indexBanner === 4) {
        bannersWrap.style.transition = 'none'; // Выключаем плавность
        indexBanner = 1;                 // Мгновенно переносим на настоящий 1-й слайд
        bannersWrap.style.transform = `translateX(-100vw)`;
    }

    // Если долетели до левого клона (копия 3-го слайда)
    if (indexBanner === 0) {
        bannersWrap.style.transition = 'none'; // Выключаем плавность
        indexBanner = 3;                 // Мгновенно переносим на настоящий 3-й слайд
        bannersWrap.style.transform = `translateX(-300vw)`;
    }
  });


function freezeSlider()
{
  banners.forEach((banner, i) =>
    {
      banner.addEventListener("mouseenter", () =>
        {
          clearInterval(timerSlider);
        })
    })
}

function unfreezeSlider(){
  banners.forEach((banner, i) =>
{
  banner.addEventListener("mouseleave", () =>
    {
      startSlider();
    })
  })
}

function startSlider()   // таймер 3с на автоматическое переключение слайдов
{
  clearInterval(timerSlider);  // обнуляет время при перелистывании 
  timerSlider = setInterval(() =>
  {
    nextSlide();
  }, 3000);
}

