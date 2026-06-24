// const cards = document.querySelectorAll('.mClassCard');
const toggleBtns = document.querySelectorAll('.cardBtn');


    toggleBtns.forEach(btn => {

      btn.addEventListener('click', () => {

        let currentCard = btn.closest('.mClassCard');
        // console.log(currentCard)
        // Переключаем класс активности на карточке
        currentCard.classList.toggle('is-expanded');
        
        // Меняем текст кнопки в зависимости от состояния
        if (currentCard.classList.contains('is-expanded')) {
            btn.textContent = 'Свернуть';
        } else {
            btn.textContent = 'Подробнее';
        }
});  
    });

