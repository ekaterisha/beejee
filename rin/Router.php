<?php namespace beejee\rin;
use beejee\rin\Session;

 class Router {
    private static $mysqli;
    private static $controllers;
    private static $instance;  // экземпляр объекта
    private function __construct(){ 
        /* ... @return Base */ }  // Защищаем от создания через new Base
    private function __clone()    { /* ... @return Base */ }  // Защищаем от создания через клонирование
    private function __wakeup()   { /* ... @return Base */ }  // Защищаем от создания через unserialize
    public static function getInstance() {    // Возвращает единственный экземпляр класса. @return Base
        if ( empty(self::$instance) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    public static function run() { 
        $r = isset($_GET["r"]) ? $_GET["r"] : 'Main'; 
        if (!isset(self::$controllers)) {
            $name_controller = __NAMESPACE__.'\Controllers\\'.$r.'Controller';
            self::$controllers = new $name_controller;
        }

        $controller = Session::get_state($name_controller);
        $action = isset($_GET["action"]) ? $_GET["action"] : 'read';
        $controller->$action();

    }
 }


?>