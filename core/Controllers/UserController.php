<?php
    session_start();
    
    require_once '../Modules/UserModules.php';

    if($_GET['action']=="register"){
    
        $login = $_POST['login'];

        $name = $_POST['name'];
    
        $password = md5($_POST['password']);

        $role = $_POST['role'];

        UserModel::register($login, $name, $password, $role);

        header("Location: ../../pages/add_user.php");
    }

    elseif($_GET['action']=="userRegister"){
    
        $login = $_POST['login'];

        $name = $_POST['name'];

        $password = md5($_POST['password']);

        $role = "user";

        UserModel::userRegister($login, $name, $password, $role);

        header("Location: ../../pages/identification.php");
    }

    elseif($_GET['action']=="identification"){

        $login = $_POST['login'];

        $password = md5($_POST['password']);

        UserModel::identification($login, $password);
    }

    elseif($_GET['action']=="logout"){
        session_start();
        session_destroy();
        header("Location: ../../index.php");

    }


?>