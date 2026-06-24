<?php session_start(); 

if(!isset($_SESSION['user']))
 {
    header('Location:index.php');
    exit();
 }

require_once 'database/dbconnect.php';

$stmtCategories = $conn->query("SELECT * FROM categories");
$categories = $stmtCategories->fetchAll(PDO::FETCH_ASSOC); // возвр ассоц. массив. а есть PDO:FETCH_COLUMN - только значения (строки)
$stmtMasterClasses = $conn->query("SELECT * FROM masterclasses");
$masterclasses = $stmtMasterClasses->fetchAll(PDO::FETCH_ASSOC);

$stmtRequests = $conn->query("SELECT * FROM requests");
$requests = $stmtRequests->fetchAll(PDO::FETCH_ASSOC);



// foreach ($categories as $c) {
//      print_r($c);
//  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ArtSpace | Админ-панель</title>
    <link rel="stylesheet" href="css/adminPanel.css">
    <script src="js/adminPanel.js" defer></script>
    <script src="js/burgerMenu.js" defer></script>
    <script src="js/theme-switcher.js" defer></script>
    <script src="js/sessionMsg.js" defer></script>
    <link rel="stylesheet" href="css/burgerMenu.css">
    <link rel="stylesheet" href="css/themes.css">
    <link rel="stylesheet" href="css/theme-switcher.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


</head>
<body>
    <header>
        <h2>Админ-панель</h2>
        <p>Вы вошли как: <?=$_SESSION['user']['userLogin']?></p>
    </header>

    <?php if(isset($_SESSION['adminMessage']))
      {?>
        <p class="sessionMsg"> <?= $_SESSION['adminMessage'];?> </p>
    <?php unset($_SESSION['adminMessage']); } ?>

    <div class="forms">
        
            <form action="php/addMasterClass.php" class="addMasterClass" method="POST">
                <h3>Создать мастер-класс</h3>

                <label for="title">Название мастер-класса</label>
                <input type="text" minlength="8" required name="title" id="title" placeholder="Название мастер-класса..">

                <label for="desc">Описание мастер-класса</label>
                <textarea name="description" required id="desc" placeholder="Описание мастер-класса.."></textarea>

                <label for="category">Категория мастер-класса</label>
                <select name="category" id="category">
                    <?php foreach ($categories as $category): ?>
                             <option value="<?php echo $category['id'];?>"><?php echo $category['categorytitle'];?></option>
                    <?php endforeach; ?>    
                </select>
                
                <p>Дата(ы) проведения:</p>
                <div class="dates" id="dates">

                </div>
                <button class="addDate">Добавить</button>
                <button class="delDate">Убрать</button>

                <input type="submit" value="Создать" id="masterClSubmit">
            </form>
            

            <form action="php/addCategory.php" class="addCategory" method="POST">
                <h3>Создать категорию</h3>
                <input type="text" name="categoryTitle" placeholder="Название..">
                <input type="submit" value="Создать">
            </form>


            <form action="php/delMasterClass.php" class="delMasterClass" method="POST">
                <h3>Удалить мастер-класс</h3>
                <select name="delMasterClass" id="delMasterClass">
                    <?php foreach ($masterclasses as $mclass): ?>
                            <option value="<?php echo $mclass['title'];?>"><?php echo $mclass['title'];?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Удалить">
            </form>



            <form action="php/delCategory.php" class="delCategory" method="POST">
                <h3>Удалить категорию</h3>
                <select name="delCategory" id="delCategory">
                    <?php foreach ($categories as $category): ?>
                            <option value="<?php echo $category['categorytitle'];?>"><?php echo $category['categorytitle'];?></option>
                    <?php endforeach; ?>
                </select>
                <input type="submit" value="Удалить">
            </form>

        </div>

        <h2>Заявки на участие в мастер-классах</h2>
        <div class="requestsWrap">
            <div class="requests">

                    <div class="id">ID заявки</div>
                    <div class="userId">ID пользователя</div>
                    <div class="mcId">ID мастер-класса</div>
                    <div class="visDate">Желаемая дата посещения</div>
                    <div class="payment">Способ оплаты</div>
                    <div class="stat">Статус заявки</div>
                    <div class="createdDate">Дата заявки</div>

                <?php foreach ($requests as $request):?>
                    <div class="cell"><?=$request['id']?></div>
                    <div class="cell"><?=$request['user_id']?></div>
                    <div class="cell"><?=$request['masterclass_id']?></div>
                    <div class="cell"><?=$request['visit_date']?></div>

                    <?php switch ($request['payment']):
                        case 'transfer':
                            $request['payment'] = 'Перевод';
                            break;
                        case 'cash':
                            $request['payment'] = 'Наличные';
                            // break;
                        endswitch; ?>
                    <div class="cell"><?=$request['payment']?></div>

                    <?php switch ($request['status']):
                        case 'sent':
                            $request['status'] = 'Подана';
                            break;
                        case 'confirmed':
                            $request['status'] = 'Подтверждена';
                            break;
                        case 'completed':
                            $request['status'] = 'Мастер-класс проведён';
                            // break;
                        endswitch; ?>
                    <div class="statCell"><?=$request['status']?>
                    <form action="php/changeStatus.php" method="POST">
                        <select name="status" id="">
                        <option value="sent">Подана</option>
                        <option value="confirmed">Подтверждена</option>
                        <option value="completed">Мастер-класс проведён</option>
                        </select>
                        <input type="hidden" name="id" value="<?=$request['id']?>"> 
                        <button type="submit">ОК</button>
                    </form>
                    </div>

                    <div class="cell"><?=$request['created_at']?></div>
                <?php endforeach; ?>
            </div>
        </div>
</body>
</html>