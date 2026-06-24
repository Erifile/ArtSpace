
//создаем функцию, которая генерирует верстку меню
function initBurgerMenu() {
  // находим контейнер на странице, куда нужно вставить бургер (например, header)
  const header = document.querySelector('header');
  if (!header) return; // Если шапки нет на странице, выходим

  // Создаем строку с HTML-кодом меню
  const burgerHTML = `
    <button class="burgerBtn">
      <span id="span1"></span>
      <span id="span2"></span>
      <span id="span3"></span>
      <nav class="menu">
        <a href="mainPage.php">Главная</a>
        <a href="mainPage.php#mClasses">Каталог</a>
      </nav>
    </button>
  `;

  // добавление внутрь хедера
  header.insertAdjacentHTML('beforeend', burgerHTML);






const burgerBtn = document.querySelector(".burgerBtn");
const menu = document.querySelector(".menu");
const span1 = document.querySelector("#span1");
const span2 = document.querySelector("#span2");
const span3 = document.querySelector("#span3");


// toggle заместо add (1/0, true/false);
burgerBtn.addEventListener('click', () => {
  burgerBtn.classList.toggle('active');
  menu.classList.toggle('open');
  
  if (burgerBtn.classList.contains('active'))
    {
      span1.classList.add("span1");
      span2.classList.add("span2");
      span3.classList.add("span3");
    }
  else 
    {
      span1.classList.remove("span1");
      span2.classList.remove("span2");
      span3.classList.remove("span3");
    }
    
})
};

/* вставляет бургер-меню после загрузки страницы */
document.addEventListener('DOMContentLoaded', initBurgerMenu);