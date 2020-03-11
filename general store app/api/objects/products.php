<?php

class Products{
 
    // database connection and table name
    private $conn;
    private $table_name = "products";
 
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function list(){
        // select all query
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->query($query);
        return $stmt;
    }
    
}