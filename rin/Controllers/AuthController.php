<?php namespace beejee\rin\Controllers;
use beejee\rin\Session;

class AuthController {

    public function __construct(){
        $this->model = new \beejee\rin\Models\UserModel();
    }

    public function create(){
        $login = $_POST['login'];
        $password = $_POST['password'];
        $result = $this->model->getData($login, $password);
        if (isset($result)) {
            Session::log_in();
        }else {
            echo 'неверный пароль';
        }
        header("Location: index.php?".$_GET['callback']);
    }

    public function logout(){
        Session::log_out();
        header("Location: index.php?".$_GET['callback']);
    }
}
?>