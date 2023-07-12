<?php

require_once __DIR__.'/BaseDao.class.php';

class UserDao extends BaseDao{

    public function __construct(){
      parent::__construct("user");
    }

    public function get_user_by_username($username){
      return $this->query_unique("SELECT * FROM user WHERE username = :username", ['username' => $username]);
    }

    

 

/*  public function add_element($registerUser){
    
      return $this->query_unique("INSERT INTO user (username, password, phone, secret, email) VALUES ('$username', '$password', '$phone', '$secret', '$email')");
    }  */
} 

?>