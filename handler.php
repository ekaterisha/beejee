<?php
include 'Controllers/MainController.php';

$controller = new MainController();
var_dump($_POST);
var_dump($_GET);
die();
switch ($_GET['action']) {
    case 'insert':
        $controller->insert();
    break;
    case 'delete':
        $controller->now_page = $_GET['now_page'];

        $controller->delete($_GET['id']);
        
    break;
    case 'update':
        $controller->update();
    break;
} 

    
/*
session_start();
$status = $_POST['status'];
$fio = $_POST['fio'];
$email = $_POST['email'];
$task_text = $_POST['task_text'];
$_SESSION['mysql'][] = array('status' => $status, 'fio' => $fio, 'email' => $email, 'task_text' => $task_text);
echo '<pre>';
var_dump($_SESSION); 
echo '</pre>';

header("Location: index.php?page='.$last_page.'"); 
//redirect('index.php');
*/
?>