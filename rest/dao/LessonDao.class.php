<?php

require_once __DIR__.'/BaseDao.class.php';

class LessonDao extends BaseDao{

    public function __construct(){
      parent::__construct("lessons");
    }



  /*   public function get_lessons($id){
      return $this->get_lessons("SELECT * FROM lessons WHERE level_id = :id", ['level_id' => $id]);
    } */




} 

?>