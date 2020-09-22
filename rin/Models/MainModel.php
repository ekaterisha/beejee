<?php namespace beejee\rin\Models;
use beejee\rin\Connect;
class MainModel {
    
    public function getCount(){ 
        return Connect::dbmass('select count(*) as cnt from task')[0]['cnt'];
    }

    public function getData(){ 
        return Connect::dbmass('select * from task');
    }

    public function setData($insert_array){
        Connect::dbmass('insert into task ('.implode(',', array_keys($insert_array)).') 
                         values ('.implode(',', array_values($insert_array)).');'
                        );
    }

    public function deleteData($id){ 
        return Connect::dbmass('delete from task
                                where id='.$id.';');
    }
    
    public function updateData($id_to_update, $values_to_update){
        $string = implode(', ', array_map(
                                function ($v, $k) {
                                        return $k.'='.$v;
                                },
                                $values_to_update, 
                                array_keys($values_to_update)
                                )
                         );
        Connect::dbmass('update task set '.$string.' 
                         where (id = '.$id_to_update.');'
                       );
    }
}
?>