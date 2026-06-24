<?php session_start(); ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtSpace | Регистрация</title>
    <link rel="stylesheet" href="css/indexstyle.css">
    <script src="js/regForm.js" defer></script>
</head>
<body>



    <div id="Wrap">

        <div id="title">
            <h1>ArtSpace</h1>
            <h2>Регистрация</h2>
        </div>

        <form action="php/reg.php" method="POST" id="form">

            <div class="inputs">

            <label for="login">Логин</label>
            <input type="text" required name="login" id="login" placeholder="Создайте логин..">

            <label for="password">Пароль (8-30 символов, без пробелов)</label>
            <input type="password"  class="password" required name="password" id="password" placeholder="Создайте пароль..">

            <label for="repPassword" >Повтор пароля</label>
            <input type="password"  class="password" required name="repPassword" id="repPassword" placeholder="Введите пароль повторно..">

            <p id="message"></p>

            <label for="fio">ФИО</label>
            <input type="text" required name="fio" id="fio" placeholder="Ваше ФИО..">

            <label for="email">Почта</label>
            <input type="email" required name="email" id="email" placeholder="Введите почту..">

            <label for="tel">Телефон</label>
            <input type="tel" required name="tel" id="tel" placeholder="Введите телефон..">

            <?php 
            if(isset($_SESSION['message'])): ?>
            <p class="sessionMsg"> <?php echo $_SESSION['message']; ?></p>
            <?php unset($_SESSION['message']);
            endif;

            // вывод массива ошибок регистрации ($_SESSION['errors']) в список
            if(isset($_SESSION['errors'])):
                echo '<ul class="error-list">';
                foreach ($_SESSION['errors'] as $err) {
                    echo '<li>'.$err.'</li>';
                }
                echo '</ul>';
                unset($_SESSION['errors']);
            endif;
            ?>


            <label for="accept">Согласен на обработку персональных данных</label>
            <input type="checkbox" required name="accept" id="accept">

            
            <input type="submit" value="Зарегистрироваться" id="submit">

            </div>

            <a href="authPage.php">Есть аккаунт?</a>

        </form>
    </div>
</body>
</html>