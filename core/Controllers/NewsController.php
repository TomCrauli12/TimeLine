<?php
    session_start();
    
    require_once '../Modules/NewsModules.php';

    $author = $_SESSION['id'];

    if($_GET['action']=="deletedMainNews"){

        $id = $_GET['id'];

        MainNews::deletedMainNews($id);

        header("Location: ../../index.php");
        
    }
    elseif($_GET['action']=="redactMainNews"){

        $title = $_POST['title'];

        $description = $_POST['description'];

        $id = $_GET['id'];

        MainNews::redactMainNews($title, $description, $id);

        header("Location: ../../index.php");

    }


        elseif($_GET['action']=="deletedNews"){
        
            var_dump($_GET['id']);

        $id = $_GET['id'];

        News::deletedNews($id);

        header("Location: ../../index.php");

    }

        elseif($_GET['action']=="redactNews"){

        $title = $_POST['title'];

        $description = $_POST['description'];

        $id = $_GET['id'];

        News::redactNews($title, $description, $id);

        header("Location: ../../index.php");

    }









    