<?php
session_start();

require_once __DIR__ . '/../../DB/DB.php';
require_once __DIR__ . '/../Modules/PreNewsModules.php';


if ($_GET['action'] == "publishNews") {

    $preNewsId = $_GET['id'];

    $conn = DB::getConnection();
    $query = $conn->prepare("SELECT `title`, `description`, `shortDescription`, `glavImage`, `imageTwo`, `imageThree`, `author` FROM PrePosts WHERE id = ?");
    $query->execute([$preNewsId]);
    $data = $query->fetch(PDO::FETCH_ASSOC);

    if ($data) {
        $title = $data['title'];
        $description = $data['description'];
        $shortDescription = $data['shortDescription'];
        $glavImage = $data['glavImage'];
        $imageTwo = $data['imageTwo'];
        $imageThree = $data['imageThree'];
        $author = $data['author'];
        $date = date('Y-m-d H:i');

        PreNews::publishNews($title, $description, $shortDescription, $glavImage, $imageTwo, $imageThree, $author, $date);

        $deleteQuery = $conn->prepare("DELETE FROM PrePosts WHERE id = ?");
        $deleteQuery->execute([$preNewsId]);

        header("Location: ../../pages/preNews.php");
    } else {
        echo "Запись не найдена.";
    }
}
