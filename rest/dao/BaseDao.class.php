<?php

require_once __DIR__.'/../env.class.php';
class BaseDao{

    private $conn;
    private $table_name;

    public function __construct($table_name){

        $this -> table_name = $table_name;
        $servername = Env::DB_HOST();
        $username = Env::DB_USERNAME();
        $password = Env::DB_PASSWORD();
        $schema = Env::DB_SCHEME();
        $port = Env::DB_PORT();
        

        $this->conn = new PDO("mysql:host=$servername;port=$port;dbname=$schema", $username, $password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function get_all(){
      $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name);
      $stmt->execute();
      return $stmt -> fetchAll(PDO::FETCH_ASSOC); //FETCH ASSOC means that output will be associative array -> it is more readable   
  }

  public function adding_contact_message($data)
  {

  $query = "INSERT INTO ".$this->table_name." (";
  foreach ($data as $column => $value){
    $query .=$column.", ";
  }
  $query = substr($query,0,-2);
  $query .=") VALUES (";
  foreach ($data as $column => $value){
    $query .= ":".$column.", ";
  }
  $query = substr($query,0,-2);
  $query .= ")";

  $stmt = $this->conn->prepare($query);
// $data['id'] = $this->conn->lastInsertId();
  $stmt->execute($data);
  return $data;
          }


    public function add_element($data){
      $query = "INSERT INTO ".$this->table_name." (";
      foreach ($data as $column => $value){
        $query .=$column.", ";
      }
      $query = substr($query,0,-2);
      $query .=") VALUES (";
      foreach ($data as $column => $value){
        $query .= ":".$column.", ";
      }
      $query = substr($query,0,-2);
      $query .= ")";
  
      $stmt = $this->conn->prepare($query);
      if ($stmt->execute($entity)) {
          $entity['id'] = $this->conn->lastInsertId();
          return $entity;
      } else {
          // Handle the failure case or log the error message
          $errorInfo = $stmt->errorInfo();
          error_log("Error executing query: " . $errorInfo[2]);
          return false;
      }
    // $data['id'] = $this->conn->lastInsertId();
      $stmt->execute($data);
      return $data;
          }

        
          protected function query($query, $params = []){
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
          }
    
          protected function query_unique($query, $params = []){
            $result = $this->query($query, $params);
            return reset($result);
          }
    

    public function add($entity){
        return $this->add_element($entity);
    }

    public function get_tutorials(){
      $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_lessons($id){
      $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name ." WHERE id = $id");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_levels(){
      $stmt = $this->conn->prepare("SELECT * FROM ".$this->table_name);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($id){
      $stmt = $this->conn->prepare("DELETE FROM ".$this->table_name." WHERE id = :id");
      $stmt->bindParam(':id',$id);
      $stmt->execute();
    }


    public function update($id, $data, $id_column = "id"){
      $query = "UPDATE " .$this->table_name. " SET ";
      foreach($data as $name=>$value){
        $query .= $name ."= :". $name. ", ";
      }
  
      $query = substr($query,0,-2);
      $query .= " WHERE {$id_column} = :id";
  
      $stmt = $this->conn->prepare($query);
      $data['id']= $id;
      $stmt->execute($data);
    }

}
?>
