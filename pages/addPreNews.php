<?php
session_start();

require_once '../DB/db.php';



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/static.css">
    <link rel="stylesheet" href="../style/pages/addPreNews.css">
    <link rel="stylesheet" href="../style/media/addPreNews_media.css">
    <title>Document</title>
</head>
<body>
    <style>
        body{
            display: flex;
        }
        form{
            display: flex;
            flex-direction: column;
        }
    </style>
    <form action="../core/Controllers/PreNewsController.php?action=addPreNews" method="post" enctype="multipart/form-data">
            <label>Title</label>
            <input type="text" name="title" required="" placeholder="Заголовок">                 
            
            <label>Description</label>
            <textarea name="description" id="" placeholder="Информация"></textarea>
            <label for="glavImage">Главное изображение</label>
            <input type="file" name="glavImage">

            <label for="imageTwo">Дополнительные изображения</label>
            <input type="file" name="imageTwo">
            <input type="file" name="imageThree">

            <button class="button" type="submit">Предложить новость</button>
            <br>
            <a href="../index.php">вернуться назад</a>
    </form>
</body>
</html>