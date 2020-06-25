<?php 
class MainController {

    public function run(){

        $model = new MainModel();
        $model->getData();
        return include 'Views/MainView.php';
        var_dump($model);
    }
}
?>