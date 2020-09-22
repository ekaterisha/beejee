<?php namespace beejee\rin\Models;
use beejee\rin\Connect;
class MainModel {
    
    public function getData(){ 
        return Connect::dbmass('select * from task');
    }
    /*
    public function setData(){/*
        $id = $_SESSION['max_id']++;
        var_dump($_POST); die();
        $status = isset($_POST['status']) ? $_POST['status'] : 'undone';
        $fio = $_POST['fio'];
        $email = $_POST['email'];
        $task_text = $_POST['task_text'];
        $insert_array =  array('id'=> $id,
                                     'status' => $status, 
                                     'fio' => $fio, 
                                     'email' => $email, 
                                     'task_text' => $task_text);

        $_SESSION['mysql'][] = $insert_array;

    }*/
}
?>