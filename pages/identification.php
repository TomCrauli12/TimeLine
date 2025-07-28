<?php
session_start();

require_once '../DB/db.php';

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
    <link rel="stylesheet" href="../style/pages/identification.css">
    <link rel="stylesheet" href="../style/media/identification_media.css">
    <title>Document</title>
</head>
<body>
    <form action="../core/Controllers/UserController.php?action=identification" method="post">
      <div class="theme">
        <h1>Войти в аккаунт</h1>
        <div class="label_cont">
          <label>Login</label>
          <input type="login" name="login" required="" placeholder="login">
        </div>
        <div class="label_cont">                    
          <label>Password</label>
          <input type="password" name="password" required="" placeholder="password">
        </div>
      </div>
      <br>
      <div class="batton">
        <button class="button" type="submit">войти</button>
        <div class="back">
          <p>нет аккаунта ?</p>
          <a href="./register.php">зарегестрироваться</a>
        </div>
      </div>
    </form>
</body>
</html>