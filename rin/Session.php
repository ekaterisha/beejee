<?php namespace beejee\rin;
session_start();

 class Session {

   public static function log_in(){
      $_SESSION['admin_auth'] = 1;
   }

   public static function log_out(){
      unset($_SESSION['admin_auth']);
   }

   public static function is_logged(){
      return isset($_SESSION['admin_auth']) ? true : false;  
   }

   public static function save_state($class){
      $_SESSION['instanses'][get_class($class)] = serialize($class);
   }

   public static function get_state($class_name){
      return isset($_SESSION['instanses'][$class_name]) ? unserialize($_SESSION['instanses'][$class_name]) : new $class_name;
   }
 }
 ?>