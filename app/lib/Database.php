<?php

namespace app\lib;

use mysqli;
use mysqli_stmt;

class Database
{
    protected $db;
    protected $lastError;
    
    public function __construct(){
       $this->db = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);
       if ($this->db->connect_errno) {
        $this->lastError = "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
       }

    }

    public function query($sql, $params = []){
        $stmt = new mysqli_stmt($this->db, $sql);
        foreach ($params as $key => $value) {          
            $stmt->bind_param(':'.$key, $value);
        }
        
        $stmt->execute();
        return $stmt->get_result();
    }

    public function rows($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function columns($sql, $params = []){
        $result = $this->query($sql, $params);
        return $result->fetch_fields();
    }

}
