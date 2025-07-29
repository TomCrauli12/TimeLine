<?php
    session_start();

    require_once './DB/DB.php';
    require_once './core/Modules/UserModules.php';
    require_once './core/Modules/UserModules.php';

    $conn = DB::getConnection();

    $query = $conn->query("SELECT * FROM News WHERE glavNews = 'нет' ORDER BY date DESC");
    $News = $query->fetchAll();

    $query = $conn->query('select * from users');
    $users = $query->fetchAll();

    $query = $conn->query("SELECT * FROM News WHERE id = (SELECT MAX(id) FROM News WHERE glavNews = 'да')");
    $MainNews = $query->fetch(PDO::FETCH_ASSOC);

    $query = $conn->query("SELECT * FROM News WHERE glavNews = 'да' AND id != (SELECT MAX(id) FROM News WHERE glavNews = 'да')");
    $remainingMainNews = $query->fetchAll(PDO::FETCH_ASSOC);

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
    <?php if ($MainNews): ?>
    <div class="main_image_news_conteiner">
        <a href="./pages/NewsPage.php?id=<?=$MainNews['id']?>"><img src="./imageNews/<?=$MainNews['glavImage']?>" alt="" class="bg-main-image"></a>
        <div class="text-content">
            <a href="./pages/NewsPage.php?id=<?=$MainNews['id']?>"><h1><?=$MainNews['title']?></h1></a>
            <a href="./pages/NewsPage.php?id=<?=$MainNews['id']?>"><p><?=$MainNews['shortDescription']?></p></a>
            <a href="./pages/NewsPage.php?id=<?=$MainNews['id']?>"><p><?=$MainNews['date']?></p></a>
            <br>
            <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor")): ?>
            <div class="admin_button">
                <a href="./core/Controllers/NewsController.php?action=deletedNews&&id=<?=$MainNews['id']?>">удалить</a>
                <a href="./pages/redactNews.php?id=<?=$MainNews['id']?>">редактировать</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
    <?php
    else:
        echo "<p>Нет главных новостей для отображения.</p>";
    endif;
    ?>



        <div class="additionally_main_news_info">
            <hr/>
            <div class="additionally_main_news_info_list">
            <?php foreach($remainingMainNews as $key): ?>
                <a href="./pages/NewsPage.php?id=<?=$key['id']?>"><?=$key['title']?></a>
            <?php endforeach; ?>
            </div>
        </div>
         
    </section>
    
    <section class="news_section">

        <?php foreach($News as $key): ?>
    
            <div class="news_conteiner">
                <div class="image_news">
                    <div class="image_news_conteiner">
                        <a href="./pages/NewsPage.php?id=<?=$key['id']?>"><img src="./imageNews/<?=$key['glavImage']?>" alt=""></a>
                    </div>
                </div>
                <div class="info_news">
                    <div class="text_news_conteiner">
                        <div class="title_news">
                            <h1><a href="./pages/NewsPage.php?id=<?=$key['id']?>"><?=$key['title']?></a></h1>
                        </div>
                        <div class="info_news">
                            <p id="shortDescription">
                                <a href="./pages/NewsPage.php?id=<?=$key['id']?>"><?=$key['shortDescription']?></a>
                            </p>
                        </div>
                    </div>

                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor")): ?>
                    <div class="admin_buttons">
                        <a href="./core/Controllers/NewsController.php?action=deletedNews&&id=<?=$key['id']?>">удалить</a>
                        <a href="./pages/redactNews.php?id=<?=$key['id']?>">редактировать</a>
                    </div>
                    <?php else: ?>

                    <?php endif; ?>
                </div>
            </div>

        <?php endforeach; ?>

    </section>

    <script src="./scripts/script.js"></script>
</body>
</html>