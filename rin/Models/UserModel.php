<?php namespace beejee\rin\Models;
use beejee\rin\Connect;
class UserModel {

    public function getFields(){ 
        return Connect::dbmass('select column_name from information_schema.columns where table_schema = "tasks" and table_name = "user";');
    }

    public function getData($login, $password){
        return Connect::dbmass('select * from user 
                                where login="'.$login.'" and password=password('.$password.')');
    }
}
?>