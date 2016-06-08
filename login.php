<?php
    // ini_set('display_errors','On');
    require_once("scripts/database.php");
    $db = new MySql("localhost", "ps", "psmysql01", "agregator");
    $db->connect();
    require_once("user.php");
    $user = new User();
    // $_POST['email'] = $_GET['e'];
    // $_POST['pass'] = $_GET['p'];
    switch ($_POST['action']) {
        case 'login':
            if ($user->login($_POST['email'], $_POST['pass'])) {
                header('Location: index.php');
            } else {
                $loginmessage = 'Вход не удался';
                require('page-login.php');       
            }
            break;
        case 'register':
            if ($user->register()) {    
                $user->login($_POST['email'], $_POST['pass']);
                require('letters/newsletter.php');
                send_registered();
                header('Location: index.php');
            } else {
                $regmessage = 'Регистрация неудачна';
                require('page-login.php');
                // header('Location: page-login.php');  
            }
            break;
        case 'logout':
            echo $user->logoff();
            break;
        default: 
            header('Location: page-login.php');
            break;
    }
    
?>