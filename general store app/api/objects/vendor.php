<?php

class Vendor{
 
    // database connection and table name
    private $conn;
    private $table_name = "shopkeeper";
 
    // object properties
    public $id;
    public $mobile;
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
        $this->mobile=htmlspecialchars(strip_tags($this->mobile));
        $this->password=htmlspecialchars(strip_tags($this->password));
        $this->created=htmlspecialchars(strip_tags($this->created));
        // query to insert record
        $query = "INSERT INTO " . $this->table_name .
         "(mobile, password, created) VALUES ('$this->mobile', '$this->password', '$this->created')";
    
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
                    `vendor_id`, `mobile`, `password`, `created`
                FROM
                    " . $this->table_name . " 
                WHERE
                    mobile='".$this->mobile."' AND password='".$this->password."'";
        $stmt = $this->conn->query($query);
        // execute query
        return $stmt;
    }
    function isAlreadyExist(){
        $query = "SELECT *
            FROM
                " . $this->table_name . " 
            WHERE
                mobile='".$this->mobile."'";
        $stmt = $this->conn->query($query);
        // execute query
        if($stmt->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }
}