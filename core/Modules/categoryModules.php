<?php
require_once __DIR__ . '/../../DB/DB.php';


class category{

    static function addcategory($category){
        $conn = DB::getConnection();

        $query = $conn->prepare("INSERT INTO `categories` (`category`) VALUES (?)");
        $query->execute([$category]);
    }

    static function getInfoBlock($categoryName){

        $conn = DB::getConnection();

        $query = $conn->prepare('select * from `News` where category = ?');
        $query->execute([$categoryName]);

        $result = $query->fetchAll();

        return $result;
    
    }

}




?>