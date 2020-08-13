<?php

include 'Controllers/MainController.php';
include 'Models/MainModel.php';

//var_dump($_GET);
$controller = new MainController();
$controller->run();

?>