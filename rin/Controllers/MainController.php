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
        $task_cnt = $this->model->getCount();

        if ($task_cnt % 3 == 0) {
            $this->last_page = $task_cnt/3;
        }
        else {
            $this->last_page = intval(round(($task_cnt+1)/3));
        }
    }
    private function checkPOST(){
        $values = [];
        $attributes = ['status','fio','email','task_text'];
        foreach($attributes as $attribute){
            if(isset($_POST[$attribute])){
                $values[$attribute] = '"'.$_POST[$attribute].'"';
            }
        }
        return $values;
    }

    public function read(){

        $this->findLastPage();
        $this->now_page = (isset($_GET['page']) && $_GET['page']<>'' && $_GET['page'] > 1)?intval($_GET['page']):1;
        $this->now_page = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;

        $data_provider = $this->model->getData();
        $data_provider = array_chunk($data_provider, 3);
        $data_provider = $data_provider[$this->now_page-1];

        return include 'rin/Views/MainView.php';
        
    }

    public function create(){

        $values_to_insert = $this->checkPOST();
        $this->model->setData($values_to_insert);

        $this->findLastPage();
        header("Location: index.php?page=".$this->last_page);
    }

    public function delete($id_to_delete){
        
        $this->model->deleteData($id_to_delete);
        $this->findLastPage();
        $page_to_redirect = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;
        header("Location: index.php?page=".$page_to_redirect);

    }
    
    public function update($id_to_update){

        $values_to_update = $this->checkPOST();
        $this->model->updateData($id_to_update, $values_to_update);

        $this->findLastPage();
        $page_to_redirect = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;
        header("Location: index.php?page=".$page_to_redirect);
    }

}
?>