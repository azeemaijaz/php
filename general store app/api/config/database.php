<?php
class Database{
 
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "store";
    private $username = "root";
    private $password = "";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        try{
            $this->conn = new mysqli($this->host,$this->username,$this->password, $this->db_name);
            if($this->conn->connect_errno>0){
                throw new Exception($this->conn->connect_error);
                die();
        }else{
            return $this->conn;
        }
        }catch(Exception $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
    }
}

?>