<?php
    session_start();
    
    require_once '../Modules/categoryModules.php';

    if($_GET['action']=="addcategory"){
        $category = $_POST['category'];

        category::addcategory($category);
        header("Location: ../../pages/addСategory.php");
    }



?>