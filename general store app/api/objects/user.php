<?php

class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "customer";
 
    // object properties
    public $id;
    public $username;
    public $password;
    public $created;
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // signup user
    function signup(){
        if($this->isAlreadyExist()){
            return false;
        }
        $this->username=htmlspecialchars(strip_tags($this->username));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->created=htmlspecialchars(strip_tags($this->created));
        // query to insert record
        $query = "INSERT INTO " . $this->table_name .
         "(username, password, created) VALUES ('$this->username', '$this->password', '$this->created')";
    

        // execute query
        if($this->conn->query($query)){
          $this->id = $this->conn->insert_id;
            return true;
        }
    
        return false;
        
    }
    // login user
    function login(){
        // select query
        $query = "SELECT
                    `cid`, `username`, `password`, `created`
                FROM
                    " . $this->table_name . " 
                WHERE
                    username='".$this->username."' AND password='".$this->password."'";
                    // execute query
        $stmt = $this->conn->query($query);
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                username='".$this->username."'";
                // execute query
        $stmt = $this->conn->query($query);
        if($stmt->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }
}