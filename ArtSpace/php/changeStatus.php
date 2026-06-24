<?php session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}

require_once '../database/dbconnect.php';

$requestId = $_POST['id']; // hidden input
$requestStatus = $_POST['status']; // хранит value option
// var_dump($requestId);
// var_dump($requestStatus);
$requestSql = 'UPDATE requests SET status = ? WHERE id = ?';
$requestStmt = $conn->prepare($requestSql);
$requestStmt->execute([$requestStatus, $requestId]);


$_SESSION['adminMessage'] = 'Статус заявки '.$requestId.' изменён.';
header("Location:../adminPanel.php");
exit();