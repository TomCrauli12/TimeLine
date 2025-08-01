<?php
session_start();

require_once '../DB/DB.php';

if (isset($_SESSION['id'])):
    
else:
  header("Location: ../pages/identification.php");
endif;

$conn = DB::getConnection();

$query = $conn->query('select * from categories');
$category = $query->fetchAll();

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
                        <li><a class="menu__item active" href="./addPreNews.php">Создать новость</a></li>
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


    <style>
        .form_style{
            display: flex;
        }
        form{
            display: flex;
            flex-direction: column;
        }
    </style>
    <section class="form_style">

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
    
                <div class="container_input" style="padding: 10px 0px;">
                    <p>Сделать главной новостью</p>
                        <label class="role-label">
                            <input type="radio" class="role-input" id="0" name="glavNews" value="нет" checked/>
                            <span class="role-span">Нет</span>
                        </label>
                        <label class="role-label">
                            <input type="radio" class="role-input" id="1" name="glavNews" value="да"/>
                            <span class="role-span">Да</span>
                        </label>
                </div>
                <div class="category">
                    <label for="pet-select">Выберете категорию</label>
                        <select name="category" id="">
                        <?php  if (!empty($category)) {
                                foreach($category as $key): ?>
                                    <option name="category" value="<?=$key['category']?>"><?=$key['category']?></option>
                                <?php endforeach;
                            } else {
                                echo '<option value="">Нет доступных категорий</option>';
                            }
                        ?>
                        </select>
                </div>
    
                <button class="button" type="submit">Предложить новость</button>
    
                <br>
                <a href="../index.php">вернуться назад</a>
        </form>
    </section>

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