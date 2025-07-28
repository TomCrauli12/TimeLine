<?php
session_start();

require_once __DIR__ . '/../../DB/DB.php';
require_once __DIR__ . '/../Modules/PreNewsModules.php';

if ($_GET['action'] == "publishMainNews") {

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

        $countMainNewsQuery = $conn->query("SELECT COUNT(*) FROM MainNews");
        $countMainNews = $countMainNewsQuery->fetchColumn();

        if ($countMainNews >= 5) {
            $oldMainNewsQuery = $conn->query("SELECT * FROM MainNews ORDER BY date ASC LIMIT 1");
            $oldMainNews = $oldMainNewsQuery->fetch(PDO::FETCH_ASSOC);

            if ($oldMainNews) {
                $insertNewsQuery = $conn->prepare("INSERT INTO News (title, description, shortDescription, glavImage, imageTwo, imageThree, author, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
                $insertNewsQuery->execute([
                    $oldMainNews['title'],
                    $oldMainNews['description'],
                    $oldMainNews['shortDescription'],
                    $oldMainNews['glavImage'],
                    $oldMainNews['imageTwo'],
                    $oldMainNews['imageThree'],
                    $oldMainNews['author'],
                    $oldMainNews['date']
                ]);

                $deleteOldMainNewsQuery = $conn->prepare("DELETE FROM MainNews WHERE id = ?");
                $deleteOldMainNewsQuery->execute([$oldMainNews['id']]);
            }
        }

        PreNews::publishMainNews($title, $description, $shortDescription, $glavImage, $imageTwo, $imageThree, $author, $date);

        $deletePrePostQuery = $conn->prepare("DELETE FROM PrePosts WHERE id = ?");
        $deletePrePostQuery->execute([$preNewsId]);

        header("Location: ../../pages/preNews.php");
    } else {
        echo "Запись не найдена.";
    }
}
