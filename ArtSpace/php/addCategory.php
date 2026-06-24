<?php session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}

$category = trim($_POST['categoryTitle']);

require_once '../database/dbconnect.php';
if ($category == "")
{
    $_SESSION['adminMessage'] = 'Ошибка. Пустое поле формы.';
    header("Location:../adminPanel.php");
    exit();
}
if (mb_strlen($category) < 5)
{
    $_SESSION['adminMessage'] = 'Ошибка. Название категории должно быть не менее 5 символов';
    header("Location:../adminPanel.php");
    exit();
}

//каждое новое слово с Заглавной Буквы
$category = mb_convert_case($category, MB_CASE_TITLE, 'UTF-8');


$sql = $conn->prepare("INSERT INTO categories (categorytitle) VALUES (:category)");

$sql->execute([":category" => $category]);

$_SESSION['adminMessage'] = 'Категория '.'"'.$category.'"'.' добавлена.';
header("Location:../adminPanel.php");
exit();