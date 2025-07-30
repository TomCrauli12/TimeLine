<?php
session_start();

require_once '../DB/DB.php';
require_once '../core/Modules/NewsModules.php';

$conn = DB::getConnection();

$viewNews = News::ShowNews($_GET['id']);

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
    <header>
        <div class="logo">
            <h1><a href="../index.php">TimeLine</a></h1>
        </div>
        <div class="header_info">
            <div class="container">
                <nav class="menu">
                    <ul>
                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "HR")): ?>
                        <li><a class="menu__item active" href="../index.php">Новости</a></li>
                        <li><a class="menu__item" href="./add_user.php">Добавить пользователя</a></li>
                        <li><a class="menu__item" href="./addPreNews.php">Создать новость</a></li>
                        <li><a class="menu__item" href="./preNews.php">Предложенные новости</a></li>
                        <li><a class="menu__item" href="./user_list.php">Список пользователей</a></li>
                    <?php elseif (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor")): ?>
                        <li><a class="menu__item" href="./addPreNews.php">Создать новость</a></li>
                        <li><a class="menu__item" href="./preNews.php">Предложенные новости</a></li>
                    <?php else: ?>
                        <li><a class="menu__item" href="">Новости</a></li>
                        <li><a class="menu__item" href="./addPreNews.php">Предложить новость</a></li>
                    <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <div class="search">
                    
            </div>
            </div>
            <div class="auth">
                <?php if(isset($_SESSION['login'])): ?>
                    <p><?=$_SESSION['name']?></p>
                    <a href="./core/Controllers/UserController.php?action=logout">выйти</a>
                <?php else: ?>
                    <a href="./pages/identification.php">войти</a>
                <?php endif; ?>
            </div>
    </header>


    <div class="main_image_news_conteiner">
        <img src="../imageNews/<?=$viewNews['glavImage']?>" alt="" class="bg-main-image">
        <div class="text-content">
            <h1><?=$viewNews['title']?></h1>
            <p><?=$viewNews['shortDescription']?></p>
            <p><?=$viewNews['date']?></p>
            <br>
        </div>
    </div>
    <div class="descrNews">
        <p><?=$viewNews['description']?></p>
    </div>
    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor")): ?>
        <div class="admin_button">
            <a href="../core/Controllers/NewsController.php?action=deletedMainNews&&id=<?=$MainNews['id']?>">удалить</a>
            <a href="./redactMainNews.php?id=<?=$viewNews['id']?>">редактировать</a>
        </div>
    <?php else: ?>
    <?php endif; ?>
    <br>
    <a href="../index.php">вернуться назад</a>
</body>
</html>