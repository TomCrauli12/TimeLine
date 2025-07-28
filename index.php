<?php
    session_start();

    require_once './DB/DB.php';
    require_once './core/Modules/UserModules.php';
    require_once './core/Modules/UserModules.php';

    $conn = DB::getConnection();

    $query = $conn->query('select * from News');
    $News = $query->fetchAll();

    $query = $conn->query('select * from users');
    $users = $query->fetchAll();

    $query = $conn->query('SELECT * FROM MainNews ORDER BY id DESC LIMIT 1');
    $MainNews = $query->fetch();

    $query = $conn->query('SELECT * FROM MainNews WHERE id != (SELECT MAX(id) FROM MainNews)');
    $remainingMainNews = $query->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/static.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1><a href="">TimeLine</a></h1>
        </div>
        <div class="header_info">
            <div class="info">
                <ul class="info_list" style="display: flex;">
                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "HR")): ?>
                        <li><a href="">Новости</a></li>
                        <li><a href="./pages/add_user.php">Добавить пользователя</a></li>
                        <li><a href="./pages/addPreNews.php">Создать новость</a></li>
                        <li><a href="./pages/preNews.php">Предложенные новости</a></li>
                        <li><a href="./pages/user_list.php">Список пользователей</a></li>
                    <?php elseif (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor")): ?>
                        <li><a href="./pages/addPreNews.php">Создать новость</a></li>
                        <li><a href="./pages/preNews.php">Предложенные новости</a></li>
                    <?php else: ?>
                        <li><a href="">Новости</a></li>
                        <li><a href="./pages/addPreNews.php">Предложить новость</a></li>
                    <?php endif; ?>
                </ul>
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


    <section class="main_news">
    
        <?php         
            if ($MainNews) {
        ?>
                <div class="main_image_news_conteiner">
                    <img src="./imageNews/<?=$MainNews['glavImage']?>" alt="" class="bg-main-image">
                    <div class="text-content">
                        <h1><?=$MainNews['title']?></h1>
                        <p><?=$MainNews['description']?></p>
                        <!-- <p><?=$MainNews['date']?></p> -->
                        <br>
                        <div class="admin_button">
                            <a href="./core/Controllers/NewsController.php?action=deletedMainNews&&id=<?=$MainNews['id']?>">удалить</a>
                            <a href="./pages/redactMainNews.php?id=<?=$MainNews['id']?>">редактировать</a>
                        </div>
                    </div>
                </div>
        <?php
            } else {
                echo "Нет новостей для отображения.";
            }
        ?>



        <div class="additionally_main_news_info">
            <hr/>
            <?php foreach($remainingMainNews as $key): ?>
                <a href=""><?=$key['title']?></a>
            <?php endforeach; ?>
        </div>
         
    </section>
    
    <section class="news_section">

        <?php foreach($News as $key): ?>
    
            <div class="news_conteiner">
                <div class="image_news">
                    <div class="image_news_conteiner">
                        <img src="./imageNews/<?=$key['glavImage']?>" alt="">
                    </div>
                </div>
                <div class="info_news">
                    <div class="text_news_conteiner">
                        <div class="title_news">
                            <h1><?=$key['title']?></h1>
                        </div>
                        <div class="info_news">
                            <p id="news-text-content">
                                <?=$key['description']?>
                            </p>
                            <a href="" class="expand-btn">читать далее →</a>
                        </div>
                    </div>
                    
                    <div class="admin_buttons">
                        <a href="./core/Controllers/NewsController.php?action=deletedNews&&id=<?=$key['id']?>">удалить</a>
                        <a href="./pages/redactNews.php?id=<?=$key['id']?>">редактировать</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

    </section>

    <script src="./scripts/script.js"></script>
</body>
</html>







<style>
*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}
html, body{
    background-color: rgb(31, 31, 31);
}
a{
    text-decoration: none;
    color: aliceblue;
}
h1,h2,h3,h4,h5,h6{
    color: aliceblue;
}
p{
    color: aliceblue;
}
ul{
    list-style: none;
}
header{
    display: flex;
    width: 100%;
    justify-content: space-between;
    align-items: center;
    padding: 2vw 5vw;
    background-color: black;
}
.logo>h1>a{
    font-size: 2.5vw;
}
.info_list{
    display: flex;
}
.info_list>li{
    padding: 0vw 0.5vw;
}





.main_news{
    padding: 1vw 3vw;
    display: flex;
}
.main_image_news_conteiner {
    position: relative;
    width: 60vw;
    height: 35vw;
    overflow: hidden;
    color: white;
}
.bg-main-image {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border-radius: 20px;
    object-fit: cover; 
    z-index: 1;
}
h1, p {
    position: relative;
    z-index: 2;
    margin: 0;
}
.text-content {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 2;
    padding: 20px;
    box-sizing: border-box;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 0px 0px 20px 20px;
    color: white;
}
.additionally_main_news_info{
    display: flex;
}






.news_section {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    padding: 1vw 3vw;
}
.news_conteiner{
    padding: 20px;
    margin: 5px;
    border-radius: 20px;
    background-color: black;
}
.image_news_conteiner>img{
    width: 20vw;
    border-radius: 10px;
}
.info_news{
    width: 20vw;
}
.title_news>h1{
    padding-bottom: 10px;
}
.expand-btn {
    color: #0066cc;
    cursor: pointer;
    display: inline-block;
    font-size: 17px;
}
.admin_buttons{
    padding-top: 10px;
    display: flex;
    justify-content: space-between;
}
hr{
    border: none; 
    background-color: #ffffff; 
    width: 3px;
    border-radius: 10px;
    height: 100%; 
    margin: 0 auto;
    margin: 0vw 2vw;
}

</style>