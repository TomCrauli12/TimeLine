<?php

require_once __DIR__ . '/../../DB/DB.php';

class UserModel {

    static function register($login, $name, $password, $role) {
        $conn = DB::getConnection();

        $query = $conn->prepare("SELECT * FROM `users` WHERE `login` = :login");
        $query->execute(['login' => $_POST['login']]);
        if ($query->rowCount() > 0) {
            $_SESSION['error_message'] = 'Это логин уже занят.';
            header('Location: ../../pages/add_user.php'); 
            die; 
        }

        $query = $conn->prepare("SELECT * FROM `users` WHERE `name` = :name");
        $query->execute(['name' => $_POST['name']]);
        if ($query->rowCount() > 0) {
            $_SESSION['error_message'] = 'Это имя пользователя уже занято.';
            header('Location: ../../pages/add_user.php'); 
            die; 
        }

        $query = $conn->prepare("INSERT INTO users (login, name, password, role) values (?, ?, ?, ?)");
        $query->execute([$login, $name, $password, $role]);
    }

    static function userRegister($login, $name, $password, $role) {
        $conn = DB::getConnection();

        $query = $conn->prepare("SELECT * FROM `users` WHERE `login` = :login");
        $query->execute(['login' => $_POST['login']]);
        if ($query->rowCount() > 0) {
            $_SESSION['error_message'] = 'Это логин уже занят.';
            header('Location: ../../pages/register.php'); 
            die; 
        }

        $query = $conn->prepare("SELECT * FROM `users` WHERE `name` = :name");
        $query->execute(['name' => $_POST['name']]);
        if ($query->rowCount() > 0) {
            $_SESSION['error_message'] = 'Это имя пользователя уже занято.';
            header('Location: ../../pages/register.php'); 
            die; 
        }

        $query = $conn->prepare("INSERT INTO users (login, name, password, role) values (?, ?, ?, ?)");
        $query->execute([$login, $name, $password, $role]);

    }

    static function identification($login, $password) {
        $conn = DB::getConnection();

        $query = $conn->prepare('SELECT * FROM `users` WHERE `login` = ? AND `password` = ?');
        $query->execute([$login, $password]);

        $userinfo = $query->fetch();

        if ($query->rowCount() > 0) {

            $_SESSION['login'] = $userinfo['login'];
            $_SESSION['id'] = $userinfo['id'];
            $_SESSION['role'] = $userinfo['role'];
            $_SESSION['name'] = $userinfo['name'];

            header('Location: ../../index.php');
            exit();
        } else {

            $_SESSION['error'] = 'Ошибка авторизации';
            header('Location: ../../pages/identification.php');
            exit();
        }
    }



    static function getUserInfo($author){

        $conn = DB::getConnection();

        $query = $conn->prepare("select * from users where id = ?");

        $query->execute([$author]);

        $userdata = $query->fetch();

        return $userdata;

    }
}
?>







