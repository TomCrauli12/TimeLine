<?php
session_start();

require_once '../DB/DB.php';
require_once '../core/Modules/NewsModules.php';

$conn = DB::getConnection();

$viewNews = News::ShowNews($_GET['id']);

$viewMainNews = MainNews::ShowMainNews($_GET['id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/static.css">
    <link rel="stylesheet" href="../style/pages/NewsPage.css">
    <link rel="stylesheet" href="../style/media/NewsPage_media.css">
    <title>Document</title>
</head>
<body>
    <div class="main_image_news_conteiner">
        <img src="../imageNews/<?=$viewNews['glavImage']?>" alt="" class="bg-main-image">
        <div class="text-content">
            <h1><?=$viewNews['title']?></h1>
            <p><?=$viewNews['shortDescription']?></p>
            <p><?=$viewNews['date']?></p>
            <br>
        </div>
    </div>
    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor")): ?>
            <div class="admin_button">
                <a href="./core/Controllers/NewsController.php?action=deletedMainNews&&id=<?=$MainNews['id']?>">удалить</a>
                <a href="./pages/redactMainNews.php?id=<?=$viewNews['id']?>">редактировать</a>
            </div>
            <?php else: ?>
            <?php endif; ?>

    <div class="descrNews">
        <p><?=$viewNews['description']?></p>
    </div>


    <br>
    <a href="../index.php">вернуться назад</a>
</body>
</html>