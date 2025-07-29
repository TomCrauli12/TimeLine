<?php
    session_start();
    
    require_once '../Modules/NewsModules.php';

    $author = $_SESSION['id'];

    if ($_GET['action'] == "deletedNews") {

        $id = $_GET['id'];

        News::deletedNews($id);

        header("Location: ../../index.php");

    }

    elseif($_GET['action']=="redactNews"){

        $title = $_POST['title'];

        $description = $_POST['description'];

        $shortDescription = $_POST['shortDescription'];

        $id = $_GET['id'];

        News::redactNews($title, $description, $shortDescription, $id);

        header("Location: ../../index.php");

    }









    