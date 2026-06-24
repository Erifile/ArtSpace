const dates = document.querySelector(".dates");
const addDateBtn = document.querySelector(".addDate");
const delDateBtn = document.querySelector(".delDate");
const masterClTitle = document.querySelector("#title");
const masterClSubmitBtn = document.querySelector("#masterClSubmit");
const masterClForm = document.querySelector(".addMasterClass");

// отключение стандартной html-валидации, если JS-загружен.
//для кастомного оформления ошибок в моём случае
//удобно. можно отключить чтоб всякие minlength i td не мешали
//для кастомного отображения ошибок
masterClForm.setAttribute('novalidate', true);

console.log(masterClTitle.value.length);
addDateBtn.addEventListener('click', function (event)
    {
        event.preventDefault();
        let datesCount = dates.querySelectorAll("input").length;
        if (datesCount == 5) return;

        let date = document.createElement("input");
        date.type = "datetime-local";
        date.name = `dates[${datesCount}]`;
        dates.appendChild(date);

    })

delDateBtn.addEventListener('click', function (event)
    {
        event.preventDefault();
        let datesCount = dates.querySelectorAll("input").length;
        if (datesCount == 0) return;

        let lastDate = dates.querySelector(`[name="dates[${datesCount - 1}]"]`);
        dates.removeChild(lastDate);
    })

masterClForm.addEventListener('submit', function (event)
{

    let dateInputs = dates.querySelectorAll("input");

    let inputErrors = [];
    //console.log(masterClTitle.value.length);
    if (masterClTitle.value.length < 8)
    {
        inputErrors.push('Название мастер-класса должно быть не менее 8 символов.');
        masterClTitle.style.border = '2px solid red';
    }
    if (dateInputs.length < 1)
    {
        inputErrors.push('Мастер-класс должен иметь минимум 1 дату проведения.');
        dates.style.border = '1px solid red';
    }
    // преобразуем переменную в Массив для функции find()
    dateInputs = Array.from(dates.querySelectorAll("input"));
    let blankDate = dateInputs.find(input => input.value === "");
        if (blankDate) {
            inputErrors.push('Заполните все даты проведения.');
            dates.style.border = '1px solid red';
        }

    if (inputErrors.length > 0)
        {
            let oldErrors = masterClForm.querySelector("ul");
            if (oldErrors) oldErrors.remove();

            event.preventDefault();
            let errorsList = document.createElement("ul");

            inputErrors.forEach(errorText => {
                    let li = document.createElement("li");
                    li.textContent = errorText;
                    errorsList.appendChild(li);
                });
            
            masterClForm.appendChild(errorsList);
        }




})