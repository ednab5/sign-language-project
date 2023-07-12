<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/LessonDao.class.php';

class LessonService extends BaseService{
    public function __construct(){
        parent::__construct(new LessonDao());
    }

    public function get_tutorials(){
        return $this->dao->get_tutorials();
    }

    public function get_lessons($id){
        return $this->dao->get_lessons($id);
    }
}

    ?>