<?php





// 1) 
 if ($_SERVER['REQUEST_METHOD'] !== 'POST')
    {
        http_response_code(405);
        exit();
    }

require_once '../database/dbconnect.php';  // подключение БД

session_start(); // хранилище данных сессии.. хранится пока не закроется вкладка..?


$inputs = 
[
    'login',  // явл просто строками для последующего их подставления в цикл foreach. 
    'password',
    'repPassword',
    'email',
    'tel',
    'fio'
];

// 2) ПРОВЕРКА НА ПУСТЫЕ ПОЛЯ В ФОРМЕ
foreach ($inputs as $input) 
{
    if (!isset($_POST[$input]) || $_POST[$input]=='')
        {
            $_SESSION['message'] = 'Ошибка. Есть пустые поля формы.';
            header("Location:../index.php?stat=error"); // перенаправление обратно на форму регистрации.  stat - GET параметр. отобразится в адрс. строке. статус ошибки.
            exit();
        }
}
// 3) ДОП. ПРОВЕРКА НА СОВПАДЕНИЕ ПАРОЛЕЙ
if ($_POST['password'] !== $_POST['repPassword'])
    {
        $_SESSION['message'] = 'Ошибка. Пароли не совпадают';
        header("Location:../index.php?stat=error"); 
        exit(); // принудительное завершение скрипта. (+- kak return. только не возвращает ничего и работает глобально, а не локально)
    }

// ПРОВЕРКА НА КОРРЕКТНОСТЬ EMAIL
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // 1 arg - что проверяем, 2 arg - на что проверяем.
    {
        $_SESSION['message'] = 'Ошибка. Некорректный email';
        header("Location:../index.php?stat=error"); 
        exit();
    }

 // 4) УБИРАНИЕ ПРОБЕЛОВ У ВВЕДЁННЫХ ДАННЫХ
$login = trim($_POST['login']);
$password = trim($_POST['password']);
$email = trim($_POST['email']);
$tel = trim($_POST['tel']);
$fio = trim($_POST['fio']);   

// 5) ПРОВЕРКА, ЗАНЯТЫ ЛИ LOGIN/EMAIL
// prepare() отличается от обычного запроса в БД что сначала данные обрабатываются, а потом отправляются. избегание sql инъекций
$check = $conn->prepare("select 
exists (select 1 from users where login = :login) as login_err, exists (select 1 from users where email = :email) as email_err"); //подготавливаем: говорим sql что мы хотим выбрать
$check -> execute([':login' => $login, ':email' => $email]);

$check = $check -> fetch(PDO::FETCH_ASSOC); // в ассоциативный массив

$errors = [];

if ($check['login_err'])
    {
        $errors[] = 'Логин занят';
    }
if ($check['email_err'])
    {
        $errors[] = 'Email занят';
    }
if(!empty($errors))
    {
        // implode объединяет эл-ы массива в строчку. 1 arg - разделитель эл-тов 2 arg - сам массив
        $_SESSION['message'] = implode('. ', $errors).'!';
        header("Location:../index.php?stat=error");
        exit();
    }


// 6) 
$newUser = $conn -> prepare("INSERT INTO users (login, password, fio, email, tel) VALUES (:login, :password, :fio, :email, :tel)");
$newUser -> execute  // метод prepare() подготавливает запрос со срезами (:), а execute создаёт связь-присваивание (=>) между данными 
    (
    [
        ':login' => $login,
        ':password' => password_hash($password, PASSWORD_DEFAULT),
        ':fio' => $fio,
        ':email' => $email,
        ':tel' => $tel
    ]);
    $_SESSION['message'] = 'Регистрация успешна!';
    header("Location:../authPage.php?stat=ok");
    exit();


?>