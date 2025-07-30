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
    
    $query = $conn->query("SELECT * FROM News WHERE glavNews = 'да' ORDER BY id DESC LIMIT 1 OFFSET 1");
    $secondMainNews = $query->fetch(PDO::FETCH_ASSOC);

    $query = $conn->query("SELECT * FROM News WHERE glavNews = 'да' ORDER BY id ASC LIMIT 3");
    $oldestMainNews = $query->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="./style/static.css">
    <link rel="stylesheet" href="./style/style_media.css">
    <title>Document</title>
</head>
<body>
    <header>
        <div class="logo">
            <h1><a href="./index.php">TimeLine</a></h1>
        </div>
        <div class="header_info">
            <div class="container">
                <nav class="menu">
                    <ul>
                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "HR")): ?>
                        <li><a class="menu__item active" href="./index.php">Новости</a></li>
                        <li><a class="menu__item" href="./pages/add_user.php">Добавить пользователя</a></li>
                        <li><a class="menu__item" href="./pages/addPreNews.php">Создать новость</a></li>
                        <li><a class="menu__item" href="./pages/preNews.php">Предложенные новости</a></li>
                        <li><a class="menu__item" href="./pages/user_list.php">Список пользователей</a></li>
                    <?php elseif (isset($_SESSION['role']) && ($_SESSION['role'] == "admin" || $_SESSION['role'] == "editor")): ?>
                        <li><a class="menu__item" href="./pages/addPreNews.php">Создать новость</a></li>
                        <li><a class="menu__item" href="./pages/preNews.php">Предложенные новости</a></li>
                    <?php else: ?>
                        <li><a class="menu__item" href="">Новости</a></li>
                        <li><a class="menu__item" href="./pages/addPreNews.php">Предложить новость</a></li>
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


    <section class="main_news">
    <?php if ($MainNews): ?>
    <div class="main_news_conteiner">
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
        <hr class="hr_additionally"/>
        <div class="additionally_main_news_info_list">
            <div class="news_category">
                <h1>Главные новости</h1>
            </div>
            <div class="twoGlavNews">
                <?php if ($secondMainNews): ?>
                    <a href="./pages/NewsPage.php?id=<?=$secondMainNews['id']?>"><img src="./imageNews/<?=$secondMainNews['glavImage']?>" alt=""></a>
                    <a href="./pages/NewsPage.php?id=<?=$secondMainNews['id']?>"><h2><?=$secondMainNews['title']?></h2></a>
                <?php else: ?>
                    <p>Нет новостей для отображения.</p>
                <?php endif; ?>
            </div>
            <hr>
            <br>
            <div class="oldGlavNews">
                <?php foreach($oldestMainNews as $key): ?>
                    <a href="./pages/NewsPage.php?id=<?=$key['id']?>"><h3><?=$key['title']?></h3></a>
                    <hr>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    </section>
    

    <div class="category">
        <h1>Новости</h1>
    </div>
    <section class="news_section">
        <!-- сделать таблицу с категориями и делать из вывод -->
        <!-- новости игры технологии -->
        <?php foreach($News as $key): ?>
            <div class="news_conteiner">
                <div class="image_news">
                    <div class="image_news_conteiner">
                        <a href="./pages/NewsPage.php?id=<?=$key['id']?>"><img src="./imageNews/<?=$key['glavImage']?>" alt=""></a>
                    </div>
                </div>
                <div class="info_news_conteiner">
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