<?php session_start(); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtSpace | Авторизация</title>
    <link rel="stylesheet" href="css/authPage.css">
</head>
<body>


    <div id="Wrap">

        <div id="title">
            <h1>ArtSpace</h1>
            <h2>Авторизация</h2>
        </div>

        <form action="php/auth.php" method="POST" id="form">
            <div class="inputs">

            <label for="login">Логин / Email</label>
            <input type="text" required name="login" id="login" placeholder="Введите логин или Email..">

            <label for="password">Пароль</label>
            <input type="password"  class="password" required name="password" id="password" placeholder="Создайте пароль..">

            <?php if(isset($_SESSION['message'])): ?>
            <p class="sessionMsg"> <?php echo $_SESSION['message']; ?></p>
            <?php unset($_SESSION['message']);
            endif; ?>

            <input type="submit" value="Войти">

            </div>

            <a href="index.php">Нет аккаунта?</a>

        </form>

    </div>
</body>
</html>