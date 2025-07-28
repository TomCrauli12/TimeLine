<?php

class DB{

    static function getConnection(){

        $conn = new PDO("mysql:host=localhost;dbname=TimeLine","root","root");

        !$conn ? die("DB_ERROR") : 0;
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;

    }
 
}

?>