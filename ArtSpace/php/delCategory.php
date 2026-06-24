<?php session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}


require_once '../database/dbconnect.php';

$category = trim($_POST['delCategory']); // обращение к name селекта. хранит выбранный value

$sql = $conn->prepare("DELETE FROM categories WHERE title = :category");

$delCategory = $sql->execute([":category" => $category]);

$_SESSION['adminMessage'] = 'Категория '.'"'.$category.'"'.' удалена.';
header("Location:../adminPanel.php");

exit();