<?php
require_once '../DB/DB.php';
require_once '../core/Modules/UserModules.php';
session_start();

$conn = DB::getConnection();

$query = $conn->query('select * from users');
$usersList = $query->fetchAll();
if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "HR")):
        
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
    <link rel="stylesheet" href="../style/pages/user_list.css">
    <link rel="stylesheet" href="../style/media/user_list_media.css">
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
                        <li><a class="menu__item" href="./preNews.php">Предложенные новости</a></li>
                        <li><a class="menu__item active" href="./user_list.php">Список пользователей</a></li>
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


    <div class="parent">
        <div class="div1"><p>логин</p></div>
        <div class="div2"><p>имя пользователя</p></div>
        <div class="div3"><p>роль</p></div>
    </div>

    <?php foreach($usersList as $key): ?>
    <div class="parent">
        <div class="div1"><a href=""><?=$key['login']?></a></div>
        <div class="div2"><a href=""><?=$key['name']?></a></div>
        <div class="div3"><a href=""><?=$key['role']?></a></div>
    </div>
    <?php endforeach; ?>

    <a href="../index.php">вернуться назад</a>
</body>
</html>