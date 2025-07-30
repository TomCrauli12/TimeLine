<?php
session_start();

require_once '../DB/DB.php';
require_once '../core/Modules/UserModules.php';

$conn = DB::getConnection();

$query = $conn->query('select * from PrePosts');
$preNews = $query->fetchAll();

$query = $conn->query('select * from users');
$users = $query->fetchAll();

if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor")):
        
else:
    header("Location: ../index.php");
endif;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/static.css">
    <link rel="stylesheet" href="../style/pages/preNews.css">
    <link rel="stylesheet" href="../style/media/preNews_media.css">
    <link rel="stylesheet" href="">
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
                        <li><a class="menu__item" href="../index.php">Новости</a></li>
                        <li><a class="menu__item" href="./add_user.php">Добавить пользователя</a></li>
                        <li><a class="menu__item" href="./addPreNews.php">Создать новость</a></li>
                        <li><a class="menu__item active" href="./preNews.php">Предложенные новости</a></li>
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


    <h1>Предложенные новости</h1>
    <br>
    <?php foreach ($preNews as $key): ?>
        <?php $userdata = UserModel::getUserInfo($key['author']) ?>
            <h1>Название: <?=$key['title']?></h1>
            <p>Описание: <?=$key['description']?></p>
            <img src="../imageNews/<?=$key['glavImage']?>" style="width: 300px;" alt="">
            <img src="../imageNews/<?=$key['imageTwo']?>" style="width: 300px;" alt="">
            <img src="../imageNews/<?=$key['imageThree']?>" style="width: 300px;" alt="">
            <p>Автор: <?=$userdata['name']?></p>
            <p>Роль автора: <?=$userdata['role']?></p>
            <p>Новость предожена: <?=$key['date']?></p>
            <p>Главная новость: <?=$key['glavNews']?></p>
            <br>
            <div class="admin_buttons">
                <a href="../core/Controllers/PreNewsController.php?action=deleted&&id=<?=$key['id']?>">Отказать</a>
                <a href="./redactPreNews.php?id=<?=$key['id']?>">Редактировать</a>
                <a href="../core/Controllers/publishNewsController.php?action=publishNews&&id=<?=$key['id']?>">Опубликовать</a>
            </div>
            <br>
        <?php endforeach; ?>
        <a href="../index.php">вернуться назад</a>
    

        <style>
            .admin_buttons{
                display: flex;
                flex-direction: column;
            }
        </style>


</body>
</html>