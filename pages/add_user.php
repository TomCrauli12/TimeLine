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