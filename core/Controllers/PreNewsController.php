<?php
    session_start();
    
    require_once '../Modules/PreNewsModules.php';

    $author = $_SESSION['id'];

    if($_GET['action']=="addPreNews"){
    
        $title = $_POST['title'];

        $description = $_POST['description'];

        $glavImage = $_FILES['glavImage']['name'];

        $imageTwo = $_FILES['imageTwo']['name'];

        $imageThree = $_FILES['imageThree']['name'];
        
        $date = date('Y-m-d H:i');

        PreNews::addPreNews($title, $description, $glavImage, $imageTwo, $imageThree, $author, $date);

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

        $id = $_GET['id'];

        PreNews::redactPreNews($title, $description, $id);

        header("Location: ../../pages/preNews.php");
    }


    elseif($_GET['action']=="publishNews"){

        $title = $_GET['title'];

        $description = $_GET['description'];

        $glavImage = $_GET['glavImage'];

        $imageTwo = $_GET['imageTwo'];

        $imageThree = $_GET['imageThree'];

        $author = $_GET['author'];
        
        $date = date('Y-m-d H:i');

        PreNews::addPreNews($title, $description, $glavImage, $imageTwo, $imageThree, $author, $date);

        header("Location: ../../pages/preNews.php");
    }


?>