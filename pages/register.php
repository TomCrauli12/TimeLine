<?php
require_once '../DB/db.php';
session_start();

if (isset($_SESSION['error_message'])) {
    echo $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}


if (isset($_SESSION['id'])):
  header("Location: ../index.php");
else:
  
endif;


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/static.css">
    <link rel="stylesheet" href="../style/pages/register.css">
    <link rel="stylesheet" href="../style/media/register_media.css">
    <title>Document</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data" action="../core/Controllers/UserController.php?action=userRegister">
        <h3>Регистрация</h3>

        <label>Логин</label>
        <input type="text" name="login" required="" placeholder="Ваш логин">

        <label>Имя</label>
        <input type="text" name="name" required="" placeholder="Ваш логин">

        <label>Пароль</label>
        <input type="password" name="password" required=""placeholder="Пароль">

        <button class="button" type="submit">Создать аккаунт</button>
        <div class="s">
          <a href="./identification.php">Авторизация</a>
        </div> 
    </form>
</body>
</html>