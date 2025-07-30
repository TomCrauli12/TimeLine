<?php
session_start();
require_once '../DB/DB.php';
require_once '../core/Modules/NewsModules.php';
$conn = DB::getConnection();

$query = $conn->prepare('select * from News where id = ?');
$query->execute([$_GET['id']]);
$NewsPosts = $query->fetch();

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
    <link rel="stylesheet" href="../style/pages/redactNews.css">
    <link rel="stylesheet" href="../style/media/redactNews_media.css">
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


    <form method="post" action="../core/Controllers/NewsController.php?action=redactNews&&id=<?=$_GET['id']?>">
        <label>Title</label>
        <input type="text" value="<?=$NewsPosts['title']?>" name="title" required="" placeholder="Заголовок">                 
            
        <label>Description</label>
        <textarea name="description" id="" placeholder="Информация"><?=$NewsPosts['description']?></textarea>

        <label>shortDescription</label>
        <textarea name="shortDescription" id="myTextarea" rows="4" cols="50" oninput="limitText(this, 150)" placeholder="Информация"><?=$NewsPosts['shortDescription']?></textarea>
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

