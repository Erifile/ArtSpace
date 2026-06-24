<?php session_start();

 if(!isset($_SESSION['user']))
 {
    header('Location:index.php');
    exit();
 }

 require_once 'database/dbconnect.php';

// Запрос ко всем мастерклассам
$mClassesSql = "SELECT 
    m.id, 
    m.title, 
    m.description,
    c.categorytitle,
    GROUP_CONCAT(d.date SEPARATOR '|') AS all_dates
FROM masterclasses m
JOIN categories c ON m.category_id = c.id
LEFT JOIN dates d ON m.id = d.masterclass_id
GROUP BY m.id
";
$mClassesStmt = $conn->query($mClassesSql);
$mClasses = $mClassesStmt->fetchAll(PDO::FETCH_ASSOC);








?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtSpace | Главная</title>
    <link rel="stylesheet" href="css/themes.css">
    <link rel="stylesheet" href="css/mainPage.css">
    <link rel="stylesheet" href="css/burgerMenu.css">
    <link rel="stylesheet" href="css/catalog.css">
    <script src="js/burgerMenu.js" defer></script>
    <script src="js/slider.js" defer></script>
    <script src="js/catalog.js" defer></script>
    <script src="js/sessionMsg.js" defer></script>
</head>
<body>

<?php if(isset($_SESSION['message']))
      {?>
        <p class='sessionMsg'> <?= $_SESSION['message'];?> </p>
    <?php unset($_SESSION['message']); } ?>




    <header>
        <p>Вы вошли как: <?=$_SESSION['user']['userLogin']?></p> 
        
        <div class="headerInfo">
            <?php if ($_SESSION['user']['userRole'] == 'admin'): ?>
                <a href="adminPanel.php">Админ-панель</a>
            <?php endif; ?>
            <a href="php/logOut.php">Выйти</a>
        </div>
    </header>

    <main>
        
        <section class="sliderSection">
            <div class="sliderWrap">
                <div class="slider" id="slider-content">

                    <!-- КЛОН 2 СЛАЙДА -->
                    <div class="banner banner3 clone">
                        <div class="banner-txt"> 
                            <h3>Встретьте новые знакомства</h3>
                            <p>Групповые занятия не дадут заскучать</p>
                            <a href="#">Каталог мастер-классов</a>
                        </div>
                    </div>

                    <div class="banner banner1 active">
                        <div class="banner-txt"> 
                            <h3>Откройте для себя новые увлечения</h3>
                            <p>У нас есть занятия по самым различным хобби и творческим занятиям</p>
                            <a href="catalog.php">Каталог мастер-классов</a>
                        </div>
                    </div>
                    <div class="banner banner2">
                        <div class="banner-txt"> 
                            <h3>Учитесь у мастеров своего дела</h3>
                            <p>Каждой мастер-класс - новые открытие и знания</p>
                            <a href="catalog.php">Каталог мастер-классов</a>
                        </div>
                    </div>
                    <div class="banner banner3">
                        <div class="banner-txt"> 
                            <h3>Встретьте новые знакомства</h3>
                            <p>Групповые занятия не дадут заскучать</p>
                            <a href="catalog.php">Каталог мастер-классов</a>
                        </div>
                    </div>

                    <!-- КЛОН 1 СЛАЙДА -->
                    <div class="banner banner1 clone">
                        <div class="banner-txt"> 
                            <h3>Откройте для себя новые увлечения</h3>
                            <p>У нас есть занятия по самым различным хобби и творческим занятиям</p>
                            <a href="#">Каталог мастер-классов</a>
                        </div>
                    </div>
                </div>
                <button id="prevBtn"><img src="media/strelka-vlevo.png" alt=""></button>
                <button id="nextBtn"><img src="media/strelka-vpravo.png" alt=""></button>
                <div id="indicators">
                        <div class="circle circleActive"></div>
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
            </div>
        </section>

            

        <div id="mClasses">
            <?php foreach ($mClasses as $mClass): ?>
                <div class="mClassCard">

                    <div class="cardMain">
                        <h2 class="mClassTitle"><?= $mClass['title'] ?></h2>
                        <h4>Категория:</h4>
                        <h3 class="category"><?= $mClass['categorytitle'] ?></h3>
                    </div>
                    <div class="mClassMore">
                        <div class="moreInner">
                            <div class="mClassDesc">
                                <h4>Описание:</h4>
                               <p><?= $mClass['description'] ?></p>
                            </div>
                            <?php 
                            // "Взрывной" трюк: строка "10.06|15.06" превращается в массив ['10.06', '15.06']
                            $currentDates = explode('|', $mClass['all_dates']);?>
                            <ul class="dates">
                                <h4>Даты проведения:</h4>
                                <?php foreach ($currentDates as $date): ?>
                                    <li><?= $date ?></li>   
                                <?php endforeach; ?>  
                            </ul>
                        </div>
                    </div>
                    <div class="btns">
                        <button class="cardBtn">Подробнее</button>
                        <a href="requestPage.php?id=<?= $mClass['id'] ?>" class="requestBtn">Записаться</a> 
                    </div>

                </div>
            <?php endforeach; ?>
        </div>


    </main>

    <footer>

    </footer>
</body>
</html>