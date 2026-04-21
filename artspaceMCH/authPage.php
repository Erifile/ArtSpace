<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtSpace | Авторизация</title>
    <link rel="stylesheet" href="css/authPage.css">
</head>
<body>
    <?php if(isset($_SESSION['message'])){ ?>
    <p><?php echo $_SESSION['message']; ?></p>
    <?php unset($_SESSION['message']);
       }; ?>


    <div id="Wrap">

        <h1>ArtSpace</h1>
        <h2>Авторизация</h2>

        <form action="php/reg.php" method="POST" id="form">
            <div class="inputs">

            <label for="login">Логин</label>
            <input type="text" required name="login" id="login" placeholder="Введите логин..">

            <label for="password">Пароль</label>
            <input type="password"  class="password" required name="password" id="password" placeholder="Создайте пароль..">
        
            <input type="submit" value="Авторизироваться">

            <a href=".php">Нет аккаунта?</a>

            </div>
        </form>
    </div>
</body>
</html>