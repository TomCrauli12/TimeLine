<?php
session_start();

require_once '../DB/DB.php';

$conn = DB::getConnection();


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
        <img src="./imageNews/<?=$MainNews['glavImage']?>" alt="" class="bg-main-image">
        <div class="text-content">
            <h1><?=$MainNews['title']?></h1>
            <p><?=$MainNews['shortDescription']?></p>
            <!-- <p><?=$MainNews['date']?></p> -->
            <br>
            <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor")): ?>
            <div class="admin_button">
                <a href="./core/Controllers/NewsController.php?action=deletedMainNews&&id=<?=$MainNews['id']?>">удалить</a>
                <a href="./pages/redactMainNews.php?id=<?=$MainNews['id']?>">редактировать</a>
            </div>
            <?php else: ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="descrNews">
        
    </div>
</body>
</html>