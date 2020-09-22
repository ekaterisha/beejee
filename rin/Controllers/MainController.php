<?php namespace beejee\rin\Controllers;
session_start();

class MainController {

    public $last_page;
    public $now_page;
    public $model;

    public function __construct(){
        $this->model = new \beejee\rin\Models\MainModel();
    }

    private function findLastPage(){
        $task_cnt = count($_SESSION['mysql']);
        if ($task_cnt % 3 == 0) {
            $this->last_page = $task_cnt/3;
        }
        else {
            $this->last_page = intval(round(($task_cnt+1)/3));
        }
    }

    public function read(){


        $this->findLastPage();
        //var_dump($_SESSION);
        $this->now_page = (isset($_GET['page']) && $_GET['page']<>'' && $_GET['page'] > 1)?intval($_GET['page']):1;
        $this->now_page = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;

        $this->model = new \beejee\rin\Models\MainModel();
        $data_provider = $this->model->getData();
        $data_provider = array_chunk($data_provider, 3);
        $data_provider = $data_provider[$this->now_page-1];

        return include 'rin/Views/MainView.php';
        
    }

    public function create(){
        //$this->model->setData();
        $id = $_SESSION['max_id']++;
        $status = isset($_POST['status']) ? $_POST['status'] : 'undone';
        $fio = $_POST['fio'];
        $email = $_POST['email'];
        $task_text = $_POST['task_text'];
        $_SESSION['mysql'][] =  array('id'=> $id,
                                     'status' => $status, 
                                     'fio' => $fio, 
                                     'email' => $email, 
                                     'task_text' => $task_text);
        $this->findLastPage();
        header("Location: index.php?page=".$this->last_page);
    }

    public function delete($id_to_delete){
        
        foreach($_SESSION['mysql'] as $key => $value){
            if ($value['id'] == $id_to_delete){
              unset($_SESSION['mysql'][$key]);
            }
        } 

        $this->findLastPage();
        $page_to_redirect = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;
        header("Location: index.php?page=".$page_to_redirect);

    }
    
    public function update($id_to_update){
        $_POST['status'] = isset($_POST['status']) ? $_POST['status'] : 'undone';

        $values_to_update = [];
        $attributes = ['id','status','fio','email','task_text'];
        foreach($attributes as $attribute){
            if(isset($_POST[$attribute])){
                $values_to_update[$attribute] = $_POST[$attribute];
            }
        }

        foreach($_SESSION['mysql'] as $key => $value){
            if ($value['id'] == $id_to_update){
                
                foreach($values_to_update as $k => $val){
                   // var_dump($_SESSION['mysql'][$key]);
                    $_SESSION['mysql'][$key][$k] = $val;
                }
            }  
        }
        $this->findLastPage();
        $page_to_redirect = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;
        header("Location: index.php?page=".$page_to_redirect);
    }

}
?>