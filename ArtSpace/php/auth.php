<?php

// 1)
 if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    {
        http_response_code(405);
        exit();
    }

require_once '../database/dbconnect.php';

session_start();


$inputs = 
[
    'login',
    'password'
];


foreach ($inputs as $input) 
{
    if (!isset($_POST[$input]) || $_POST[$input]=='')
        {
            $_SESSION['message'] = 'Ошибка. Есть пустые поля формы.';
            header("Location:../authPage.php?stat=error"); // перенаправление обратно на форму регистрации.  stat - GET параметр. отобразится в адрс. строке. статус ошибки.
            echo "Ошибка в проверке на пустые поля";
            exit();
        }
}


 // 4)
$login = trim($_POST['login']);
$password = $_POST['password'];
$email = trim($_POST['email']);

// 6) 
$findUser = $conn -> prepare("select * from users where login = :login or email = :email");
$findUser -> execute
    (
    [
        ':login' => $login,
        ':email' => $login // т.к. в инпуте можно ИЛИ email ИЛИ логин.
    ]);
$findUser = $findUser -> fetch(PDO::FETCH_ASSOC); // если селект не найдет ничего, то массив $checkUser выдаст emptyset

if (!$findUser || !password_verify($password, $findUser['password'])) // если массив пустой ИЛИ не прошла верификация захешированного пароля по 2-му аргументу.
{
    $_SESSION['message'] = 'Ошибка. Неверные логин/почта или пароль';
    header("Location:../authPage.php?stat=error"); 
    exit();
};

// при session_start() создаётся 2 сессионных файла - 1 на сервер и 1 на пк пользователя. 
session_regenerate_id(true); // обновление айди сессии пользователя?.. для предотвращения перехватаа трафика

$_SESSION['user'] = [ // хранение данных юзера в сессионном массиве user внутри супермассива $_SESSION (перекидывание из массива $findUser) КРОМЕ пароля.
    'userId' => $findUser['id'],
    'userLogin' => $findUser['login'],
    'userEmail' => $findUser['email'],
    'userPhone' => $findUser['tel'],
    'userFio' => $findUser['fio'],
    'userRole' => $findUser['role']
];



//$_SESSION['user']['userLogin'] // получение значения из массива user

    
$homePage = '../mainPage.php'; // создание главн. страницы в зависимости от роли пользователя

    $_SESSION['message'] = 'Авторизация успешна!';
    header("Location:".$homePage);
    exit();
// query exec там, где ввод данных - опасна
// $conn -> query("INSERT INTO users (login, password, email, phone, fio) values ('".$_POST['login']."', '".$_POST['password']."', '".$_POST['email']."', '".$_POST['phone']."', '".$_POST['fio']."')");

?>