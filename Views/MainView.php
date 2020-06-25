<?php 
// var_dump($model->Data);
$page = '';
foreach ($model->Data as $key=>$value) {
    $page .= '<div class="container"> Тут будет задача </div>'.$value['status'];
}

echo $page;
?>