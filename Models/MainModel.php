<?php 
class MainModel {
    public $now_page;
    public $Data;
    
    public function getData(){
        $_SESSION['max_id'] = isset($_SESSION['max_id']) ? $_SESSION['max_id'] : 1;

        if(!isset($_SESSION['mysql'])){
            $_SESSION['mysql'] =  array(
            ['id'=>$_SESSION['max_id']++,
            'status'=>'done',
            'fio'=>'rina',
            'email'=>'example@pir.com', 
            'task_text'=>'mvc модель'],
            ['id'=>$_SESSION['max_id']++,
            'status'=>'undone',
            'fio'=>'sasha',
            'email'=>'example234@pir.com', 
            'task_text'=>'987654 to do'],
            ['id'=>$_SESSION['max_id']++,
            'status'=>'undone',
            'fio'=>'roma',
            'email'=>'rom234@pir.com', 
            'task_text'=>'hf report to do'],
            ['id'=>$_SESSION['max_id']++,
            'status'=>'undone',
            'fio'=>'Леша',
            'email'=>'lesha@com', 
            'task_text'=>'design to do']                           
            );
            //var_dump($_SESSION); die();
        }

        $arr_pag = array_chunk($_SESSION['mysql'], 3);
        $this->Data = $arr_pag[$this->now_page-1];

       // return $arr_pag[$this->now_page-1];
    
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