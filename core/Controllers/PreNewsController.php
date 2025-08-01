<?php
    session_start();
    
    require_once '../Modules/PreNewsModules.php';

    $author = $_SESSION['id'];

    if($_GET['action']=="addPreNews"){
    
        $title = $_POST['title'];

        $description = $_POST['description'];

        $shortDescription = $_POST['shortDescription'];

        $glavImage = $_FILES['glavImage']['name'];

        $imageTwo = $_FILES['imageTwo']['name'];

        $imageThree = $_FILES['imageThree']['name'];
        
        $date = date('Y-m-d H:i');

        $glavNews = $_POST['glavNews'];

        $category = $_POST['category'];

        PreNews::addPreNews($title, $description, $shortDescription, $glavImage, $imageTwo, $imageThree, $author, $date, $glavNews, $category);

        header("Location: ../../pages/preNews.php");
    }


    elseif($_GET['action']=="deleted"){

        $id = $_GET['id'];

        PreNews::deletedPreNews($id);

        header("Location: ../../pages/preNews.php");
    }


    elseif($_GET['action']=="redactPreNews"){

        $title = $_POST['title'];

        $description = $_POST['description'];

        $shortDescription = $_POST['shortDescription'];

        $id = $_GET['id'];

        PreNews::redactPreNews($title, $description, $shortDescription, $id);

        header("Location: ../../pages/preNews.php");
    }


    elseif($_GET['action']=="publishNews"){

        $title = $_GET['title'];

        $description = $_GET['description'];

        $shortDescription = $_GET['shortDescription'];

        $glavImage = $_GET['glavImage'];

        $imageTwo = $_GET['imageTwo'];

        $imageThree = $_GET['imageThree'];

        $author = $_GET['author'];
        
        $date = date('Y-m-d H:i');

        $glavNews = $_GET['glavNews'];

        $category = $_GET['category'];

        PreNews::publishNews($title, $description, $shortDescription, $glavImage, $imageTwo, $imageThree, $author, $date, $glavNews, $category);

        header("Location: ../../pages/preNews.php");
    }


?>