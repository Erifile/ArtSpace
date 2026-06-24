<?php session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit();
}

require_once '../database/dbconnect.php';


$title = trim($_POST['title']);
$description = trim($_POST['description']);
$category_id = $_POST['category']; // обр. к селекту. хранит value выбранного option (id категории)
$dates = $_POST['dates']; // массив, задаваемый через name у дат


if (mb_strlen($title) < 8)
    {
        $_SESSION['adminMessage'] = 'Ошибка. Название мастер-класса должно быть не менее 8 букв.';
        header("Location:../adminPanel.php?stat=error");
        exit();
    }

$inputs = 
[
    'title',
    'description',
    'category'
];


foreach ($inputs as $input) 
{
    if (!isset($_POST[$input]) || $_POST[$input] == '')
        {
            $_SESSION['adminMessage'] = 'Ошибка. Есть пустые поля формы.';
            header("Location:../adminPanel.php?stat=error");
            exit();
        }
};




$masterClStmt = $conn->prepare("INSERT INTO masterclasses
(title, description, category_id)
VALUES (:title, :description, :category_id)");

$masterClStmt = $masterClStmt->execute(
    [
        ':title' => $title,
        ':description' => $description,
        ':category_id' => $category_id
    ]);

// послед. отправленное id (текущий мастер-класс)
$masterClId = $conn->lastInsertId();
var_dump($masterClId);
//$date = null;
$datesSql = "INSERT INTO dates (masterclass_id, date) VALUES (:masterClId, :date)";
$datesStmt = $conn->prepare($datesSql);
foreach ($dates as $date) { 
    // $datesStmt = $conn->prepare($datesSql);
    $datesStmt->execute(
        [
            ':masterClId' => $masterClId,
            ':date' => $date
        ]);
}

$_SESSION['adminMessage'] = 'Мастер-класс "'.$title.'" добавлен.';
header("Location:../adminPanel.php");
exit();