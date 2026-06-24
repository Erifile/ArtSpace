<?php
session_start();


if(!isset($_SESSION['user']))
 {
    header('Location:index.php');
    exit();
 }


require_once 'database/dbconnect.php';

$mClassId = $_GET['id'];


$mClassSql = "SELECT 
    m.id, 
    m.title, 
    m.description,
    c.categorytitle,
    GROUP_CONCAT(d.date SEPARATOR '|') AS all_dates
FROM masterclasses m
JOIN categories c ON m.category_id = c.id
LEFT JOIN dates d ON m.id = d.masterclass_id
WHERE m.id = ?
GROUP BY m.id
";

$mClassStmt = $conn->prepare($mClassSql);
$mClassStmt->execute([$mClassId]);
// fetch, т.к 1 строка (1 мастер-класс) и 1 массив. fetchAll возвращает массив массивов. поэтому не находило ключ
$mClass = $mClassStmt->fetch(PDO::FETCH_ASSOC);
// var_dump($mClass);
$dates = explode('|', $mClass['all_dates']);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtSpace | Запись на мастер-класс</title>
    <link rel="stylesheet" href="css/requestPage.css">
    <script src="js/burgerMenu.js" defer></script>
    <link rel="stylesheet" href="css/burgerMenu.css">
</head>
<body>
    

    <header>
        <p>Вы вошли как: <?=$_SESSION['user']['userLogin']?></p> 
        
        <div class="headerInfo">
            <?php if ($_SESSION['user']['userRole'] == 'admin'): ?>
                <a href="adminPanel.php">Админ-панель</a>
            <?php endif; ?>
            <a href="php/logOut.php">Выйти</a>
        </div>
    </header>




    <div id="Wrap">

        <div id="title">
            <h1>ArtSpace</h1>
            <h2>Запись на мастер-класс</h2>
        </div>

        <form action="php/addRequest.php?id=<?=$mClassId?>" method="POST" id="form">
            
        
            <div class="formInner">

            <div class="mClassInfo">
                <h2>Название мастер-класса:</h2>
                <p><?= $mClass['title']; ?></p>
                <h2>Категория мастер-класса:</h2>
                <p><?= $mClass['categorytitle'] ?></p>
                <h2>Описание:</h2>
                <p><?= $mClass['description']?></p>
            </div>

            <div class="userInfo">
                <h2>Ф.И.О. участника:</h2>
                <p><?= $_SESSION['user']['userFio']?></p>
                <h2>Телефон участника:</h2>
                <p><?= $_SESSION['user']['userPhone']?></p>
            </div>

            <h2>Выберите дату посещения:</h2>
            <div class="dates">
                <select name="votedDate" id="">
                       <?php for ($i=0; $i < count($dates); $i++): ?>
                    <option value="<?=$dates[$i]?>"><?=$dates[$i]?></option>

                <?php endfor;?>
                </select>
            </div>
            <h2>Выберите способ оплаты:</h2>
            <label for="transfer">Перевод картой</label>
            <input type="radio" name="payment" id="transfer" value="transfer" required>
            <label for="cash">Наличные</label>
            <input type="radio" name="payment" id="cash" value="cash" required>
            

            <input type="submit" value="Записаться">

            </div>

        </form>

    </div>



</body>
</html>