<?php

include_once 'Controllers/MainController.php';
include_once 'Models/MainModel.php';


/*if (!isset($controller)){ */
    $controller = new MainController();
    $controller->run();
//}

?>