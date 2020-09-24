<?php namespace beejee\rin\Controllers;
use beejee\rin\Session;

class MainController {

    public $last_page;
    public $now_page;
    public $model;
    public $sort_field;
    public $sort_value;

    public function __construct(){
        $this->model = new \beejee\rin\Models\TaskModel();
    }

    public function getCallback(){
        return urlencode('r='.str_replace('Controller','', array_pop(explode('\\', __CLASS__))).'&page='.$this->now_page);
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
        $attributes = $this->model->getFields();
        foreach($attributes as $attribute){
            $clmn = $attribute['column_name'];
            if(isset($_POST[$clmn])){
                $values[$clmn] = '"'.$_POST[$clmn].'"';
            }
        }
        return $values;
    }
    private function this_sort($a, $b) {
        if (strtolower($a[$this->sort_field]) == strtolower($b[$this->sort_field])) {
            return 0;
        }
        return ($a[$this->sort_field] < $b[$this->sort_field]) ? (-1 * $this->sort_value) : (1 * $this->sort_value);
    }

    public function read(){
        $show = Session::is_logged();
        $this->findLastPage();
        $this->now_page = (isset($_GET['page']) && $_GET['page']<>'' && $_GET['page'] > 1) ? intval($_GET['page']) : ((isset($this->now_page)) ? $this->now_page : 1);

        $this->now_page = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;

        if (isset($_POST['sort'])) {
            $this->sort_field = substr($_POST['sort'], 0, -2);
            $this->sort_value = substr($_POST['sort'], -2);
        }else {
            $this->sort_field = (isset($this->sort_field)) ? $this->sort_field : 'id';
            $this->sort_value = (isset($this->sort_value)) ? $this->sort_value : '+1';
        }
        $concat = $this->sort_field.$this->sort_value;
        $options = ['id+1' => 'Дата добавления',
                    'fio+1' => 'Имя ⇩',
                    'fio-1' => 'Имя ⇧',
                    'email+1' => 'E-mail ⇩',
                    'email-1' => 'E-mail ⇧',
                    'status+1' => 'Статус ⇩',
                    'status-1' => 'Статус ⇧'
                    ];
        foreach ($options as $opt){
            $sarr[$opt] = ($concat == $opt) ? 'selected' : '' ;
        }

        $data_provider = $this->model->getData();
        usort($data_provider, array(__CLASS__,'this_sort'));
        $data_provider = array_chunk($data_provider, 3);
        $data_provider = $data_provider[$this->now_page-1];

        Session::save_state($this);
        return include 'rin/Views/MainView.php';
    }

    public function create(){
        $values_to_insert = $this->checkPOST();
        $this->model->setData($values_to_insert);

        $this->findLastPage();
        header("Location: index.php?r=Main&action=read&page=".$this->last_page);
    }

    public function delete(){
        $id_to_delete = $_GET['id'];
        $this->model->deleteData($id_to_delete);
        $this->findLastPage();
        $page_to_redirect = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;
        header("Location: index.php?r=Main&action=read&page=".$page_to_redirect);
    }
    
    public function update(){
        $id_to_update = $_GET['id'];
        $values_to_update = $this->checkPOST();
        $before = $this->model->getTaskById($id_to_update);
        $this->model->updateData($id_to_update, $values_to_update);
        $after = $this->model->getTaskById($id_to_update);

        if ($before[0]['task_text'] = $after[0]['task_text']) {
            $flag["edited_by_admin"]= "1";
            $this->model->updateData($id_to_update, $flag);
        }
        $this->findLastPage();
        $page_to_redirect = $this->now_page > $this->last_page ? $this->last_page : $this->now_page;
        header("Location: index.php?r=Main&action=read&page=".$page_to_redirect);
    }
}
?>