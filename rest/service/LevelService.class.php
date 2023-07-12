<?php

require_once __DIR__.'/BaseService.class.php';
require_once __DIR__.'/../dao/LevelDao.class.php';

class LevelService extends BaseService{
    public function __construct(){
        parent::__construct(new LevelDao());
    }

    public function get_levels(){
        return $this->dao->get_levels();
    }
}

    ?>