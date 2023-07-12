<?php
abstract class BaseService{
    protected $dao;
    public function __construct($dao){
        $this->dao = $dao;
    }

    public function get_all()
    {
        return $this->dao->get_all();
    }

    public function add_element($entity){
        return $this->dao->add($entity);
    }

    public function add($entity)
    {
        return $this->dao->add_element($entity);
    }

    public function adding_contact_message($entity)
    {
        return $this->dao->adding_contact_message($entity);
    }
    
    public function update($entity, $id)
    {
        return $this->dao->update($entity, $id);
    }

    public function delete($id)
    {
        return $this->dao->delete($id);
    }
}
?>
