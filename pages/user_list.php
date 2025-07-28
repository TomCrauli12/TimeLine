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