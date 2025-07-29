<?php
session_start();

require_once '../DB/DB.php';
if (isset($_SESSION['id'])):
    
else:
  header("Location: ../pages/identification.php");
endif;


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
            <input type="text" name="title"  required="" placeholder="Заголовок">                 
            
            <label>Description</label>
            <textarea name="description" rows="20" cols="80" id="" placeholder="Информация"></textarea>

            <label>shortDescription</label>
            <textarea name="shortDescription" id="myTextarea" rows="7" cols="50" oninput="limitText(this, 150)" placeholder="Информация"></textarea>
            <p id="charCount">Осталось символов: 150</p>

            <label for="glavImage">Главное изображение</label>
            <input type="file" name="glavImage">

            <label for="imageTwo">Дополнительные изображения</label>
            <input type="file" name="imageTwo">
            <input type="file" name="imageThree">

            <p>сделать главной новостью</p>
            <input type="radio" id="0" name="glavNews" value="нет" checked/>
            <label for="0">Нет</label>

            <input type="radio" id="1" name="glavNews" value="да"/>
            <label for="1">Да</label>

            <button class="button" type="submit">Предложить новость</button>

            <br>
            <a href="../index.php">вернуться назад</a>
    </form>

    <script>
        function limitText(field, maxChar) {
            if (field.value.length > maxChar) {
                field.value = field.value.substring(0, maxChar);
            }
            document.getElementById("charCount").innerText = "Осталось символов: " + (maxChar - field.value.length);
        }
    </script>
</body>
</html>