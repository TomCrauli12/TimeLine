<?php
require_once '../DB/DB.php';
session_start();

if (isset($_SESSION['error_message'])) {
    echo $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}

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
    <link rel="stylesheet" href="../style/pages/add_user.css">
    <link rel="stylesheet" href="../style/media/add_user_media.css">
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
                        <li><a class="menu__item active" href="./add_user.php">Добавить пользователя</a></li>
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


<form method="post" action="../core/Controllers/UserController.php?action=register">
                <div class="theme">
                    <h1>Добавить пользователя</h1>
                    <div class="input-group">
                        <label>Логин</label>
                        <input type="text" name="login" id="name" required="" placeholder="логин">
                    </div>
    
                    <div class="input-group">                    
                        <label>Никнейм</label>
                        <input type="text" name="name" id="name" required="" placeholder="UserName">
                    </div>

                    <div class="input-group">                    
                        <label>Пароль</label>
                        <input type="password" name="password" id="name" required="" placeholder="пароль">
                    </div>

                    <div style="padding: 10px 0px;">
                        <p>Выберете роль пользователя</p>
                        <div class="radio_cont">
                            <div class="radio">
                                <input class="checkbox-tools" type="radio" value="user" name="role" id="User" checked>
                                <label for="User">
                                    User
                                </label>
                            </div>
                            <div class="radio">
                                <input class="checkbox-tools" type="radio" value="editor" name="role" id="Editor">
                                <label for="Editor">
                                    Editor
                                </label>
                            </div>
                            <div class="radio">
                                <input class="checkbox-tools" type="radio" value="HR" name="role" id="HR">
                                <label for="HR">
                                    HR
                                </label>
                            </div>
                            <div class="radio">
                                <input class="checkbox-tools" type="radio" value="admin" name="role" id="admin">
                                <label for="admin">
                                    Admin
                                </label>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="batton">
                    <button class="button" type="submit">Создать пользователя</button>
                    
                    <div class="back">
                        <a href="../index.php">Вернуться назад</a>
                    </div>
                </div>
            </form>
            
</body>
</html>