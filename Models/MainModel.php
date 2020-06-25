<?php 
class MainModel {
    public $Data;
    public function getData(){
        
        $this->Data =  array(['status'=>'done', 
                              'email'=>'example@pir.com', 
                              'task_text'=>'1234567 to do']);
    
    }
}
?>