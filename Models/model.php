<?php

class Model{
    
    public $db;
    
    public function __construct(){
        try{
             $this->db = new PDO('mysql:host='.DB_DNS.';dbname='.DB_NAME,DB_USER,DB_PASS);
             $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

        
    }
    
}



?>