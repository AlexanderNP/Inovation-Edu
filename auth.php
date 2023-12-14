<?php

    include('open_bd.php');
    
    $login = $_POST['login'];
    $password = $_POST['password'];

    $check = checkUser($users, $login, $password);

    if($check == false) {

        $script = 'authorization.php?error=true';
        header("Location: $script");

    }
    else {

        session_start();
        $_SESSION['user'] = $login;
        $script = 'index.php';
        header("Location: $script");

    }

    function checkUser($users, $login, $password) {
        foreach($users as $user) {
            if ($user['login'] == $login && $user['password'] == $password) {
    
                return $user;
    
            }
        }
        return false;
    }

?>