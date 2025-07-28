<?php

require_once __DIR__ . '/../../DB/DB.php';

class MainNews {

    static function deletedMainNews($id){

        $conn = DB::getConnection();

        $query = $conn->prepare("DELETE FROM MainNews WHERE id = ?");
        $query->execute([$id]);

    }

    
    static function redactMainNews($title, $description, $shortDescription, $id){
        $conn = DB::getConnection();

        $query = $conn->prepare("UPDATE MainNews SET `title` = ?, `description` = ?, `shortDescription` = ? WHERE `id` = ?");
        $query->execute([$title, $description, $shortDescription, $id]);
    }
}


class News {

        static function deletedNews($id){

        $conn = DB::getConnection();

        $query = $conn->prepare("DELETE FROM News WHERE id = ?");
        $query->execute([$id]);

    }

    
    static function redactNews($title, $description, $shortDescription, $id){
        $conn = DB::getConnection();

        $query = $conn->prepare("UPDATE News SET `title` = ?, `description` = ?, `shortDescription` = ? WHERE `id` = ?");
        $query->execute([$title, $description, $shortDescription, $id]);
    }

}