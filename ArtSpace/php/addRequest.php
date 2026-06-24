<?php session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}

if(!isset($_SESSION['user']))
 {
    header('Location:index.php');
    exit();
 }


require_once '../database/dbconnect.php';



$userId = $_SESSION['user']['userId'];
$mClassId = $_GET['id'];
$votedDate = $_POST['votedDate']; // хранит value из option
$payment = $_POST['payment']; // хранит value из radio


$requestSql = 'INSERT INTO requests 
(user_id, masterclass_id, visit_date, payment)
VALUES (:userId, :mClassId, :votedDate, :payment)';

$requestStmt = $conn->prepare($requestSql);
$requestStmt-> execute
(
    [
        ':userId' => $userId,
        ':mClassId' => $mClassId,
        ':votedDate' => $votedDate,
        ':payment' => $payment
    ]
);

$_SESSION['message'] = 'Запись на мастер-класс оформлена!';
header('Location:../mainPage.php');
exit();

