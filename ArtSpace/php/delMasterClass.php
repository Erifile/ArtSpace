<?php session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}


require_once '../database/dbconnect.php';

$mclass = trim($_POST['delMasterClass']); // обращение к name селекта. хранит выбранный value

$sql = $conn->prepare("DELETE FROM masterclasses WHERE title = :mclass");

$delCategory = $sql->execute([":mclass" => $mclass]);

$_SESSION['adminMessage'] = 'Мастер-класс '.'"'.$mclass.'"'.' удален.';
header("Location:../adminPanel.php");
exit();