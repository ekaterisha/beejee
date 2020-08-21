<?php

session_start();

class MainController {

    public $last_page;
    public $now_page;
    //public $model;

    private function findLastPage(){
        $task_cnt = count($_SESSION['mysql']);
        if ($task_cnt % 3 == 0) {
            $this->last_page = $task_cnt/3;
        }
        else {
            $this->last_page = intval(round(($task_cnt+1)/3));
        }
    }

    public function run(){


        $this->findLastPage();
        
        $this->now_page = (isset($_GET['page']) && $_GET['page']<>'' && $_GET['page'] > 1)?intval($_GET['page']):1;
        $this->now_page = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;

        $model = new MainModel();
        $model->now_page = $this->now_page;
        //$data_provider =$model->getData();
        $model->getData();

        return include 'Views/MainView.php';
        
    }

    public function insert(){
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
        $status = isset($_POST['status']) ? $_POST['status'] : 'undone';
        $fio = $_POST['fio'];
        $email = $_POST['email'];
        $task_text = $_POST['task_text'];

        foreach($_SESSION['mysql'] as $key => $value){
            if ($value['id'] == $id_to_update){
            $_SESSION['mysql'][$key] =  array('id'=> $id_to_update,
                                              'status' => $status, 
                                              'fio' => $fio, 
                                              'email' => $email, 
                                              'task_text' => $task_text);
            }
        } 
        $this->findLastPage();
        $page_to_redirect = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;
        header("Location: index.php?page=".$page_to_redirect);
    }

}
?>