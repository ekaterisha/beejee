<?php 
class MainModel {
    public $Data;
    public $now_page;
    
    public function getData(){
        $_SESSION['max_id'] = isset($_SESSION['max_id']) ? $_SESSION['max_id'] : 1;

        if(!isset($_SESSION['mysql'])){
            $_SESSION['mysql'] =  array(
            ['id'=>$_SESSION['max_id']++,
            'status'=>'done',
            'fio'=>'rina',
            'email'=>'example@pir.com', 
            'task_text'=>'567 to do'],
            ['id'=>$_SESSION['max_id']++,
            'status'=>'undone',
            'fio'=>'sasha',
            'email'=>'example234@pir.com', 
            'task_text'=>'987654 to do'],
            ['id'=>$_SESSION['max_id']++,
            'status'=>'undone',
            'fio'=>'roma',
            'email'=>'rom234@pir.com', 
            'task_text'=>'hf report to do']                           
            );
            //var_dump($_SESSION); die();
        }

        $arr_pag = array_chunk($_SESSION['mysql'], 3);
        $this->Data = $arr_pag[$this->now_page-1];
    
    }
}
?>