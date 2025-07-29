<?php

require_once __DIR__ . '/../../DB/DB.php';

class News {

    static function deletedNews($id) {
        $conn = DB::getConnection();
        $query = $conn->prepare("SELECT glavNews FROM News WHERE id = ?");
        $query->execute([$id]);
        $news = $query->fetch(PDO::FETCH_ASSOC);
        
        if ($news) {
            if ($news['glavNews'] == 'да') {
                $updateQuery = $conn->prepare("UPDATE News SET glavNews = 'нет' WHERE id = ?");
                $updateQuery->execute([$id]);
            } 
            else {
                $deleteQuery = $conn->prepare("DELETE FROM News WHERE id = ?");
                $deleteQuery->execute([$id]);
            }
        }
    }

    static function redactNews($title, $description, $shortDescription, $id){
        $conn = DB::getConnection();

        $query = $conn->prepare("UPDATE News SET `title` = ?, `description` = ?, `shortDescription` = ? WHERE `id` = ?");
        $query->execute([$title, $description, $shortDescription, $id]);
    }

    static function ShowNews($id){

        $conn = DB::getConnection();

        $query = $conn->prepare("SELECT * FROM news WHERE id =?");

        $query->execute([$id]);

        $viewNews = $query->fetch();

        return $viewNews;
    }

}