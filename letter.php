<?php
    // ini_set('display_errors','On');
    require_once("scripts/database.php");
    $db = new MySql("localhost", "ps", "psmysql01", "agregator");
    $db->connect();
    require_once('letters/newsletter.php');
    
    if ($_POST['action'] == 'subscribe') {
        send_subscribe();
    } elseif ($_POST['action'] == 'feedback') {
        send_feedback();        
    }
    header('Location: index.php');
?>