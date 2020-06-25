<?php 
include 'Controllers/MainController.php';
include 'Models/MainModel.php';
session_start();
//$_SESSION['test'] = 123;
var_dump($_SESSION);

$controller = new MainController();
$controller->run();


?>