<?php
session_start();
require_once '../DB/DB.php';
require_once '../core/Modules/NewsModules.php';
$conn = DB::getConnection();




$query = $conn->prepare('select * from News where id = ?');
$query->execute([$_GET['id']]);
$MainNewsPosts = $query->fetch();

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
    <link rel="stylesheet" href="../style/pages/redactMainNews.css">
    <link rel="stylesheet" href="../style/media/redactMainNews_media.css">
    <title>Document</title>
</head>
<body>
    <form method="post" action="../core/Controllers/NewsController.php?action=redactMainNews&&id=<?=$_GET['id']?>">
        <label>Title</label>
        <input type="text" value="<?=$MainNewsPosts['title']?>" name="title" required="" placeholder="Заголовок">                 
            
        <label>Description</label>
        <textarea name="description" id="" placeholder="Информация"><?=$MainNewsPosts['description']?></textarea>

        <label>shortDescription</label>
        <textarea name="shortDescription" id="myTextarea" rows="4" cols="50" oninput="limitText(this, 150)" placeholder="Информация"><?=$MainNewsPosts['shortDescription']?></textarea>
        <p id="charCount">Осталось символов: 150</p>

        <button class="button" type="submit">Сохранить изменения</button>
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
