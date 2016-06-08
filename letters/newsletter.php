<?php
// Credits: https://gist.github.com/mfkp/1488819
require_once("Mailchimp.php");


session_cache_limiter('nocache');
header('Expires: ' . gmdate('r', 0));
header('Content-type: application/json');
$apiKey 	= 'fdf238c563a4f947c9e7fada101fdee3-us9';   // How get your Mailchimp API KEY - http://kb.mailchimp.com/article/where-can-i-find-my-api-key

function send_registered() {
    $args = (object) array("letterFile" => "registered.txt", 
                            "subject" => "Вы зарегистрированы в Postscanner!", 
                            "listId" => "9cac6aedb5",
                            "email" => $_POST['email']);
    send_letter_with_subject($args);
}

function send_feedback() {
    $args = (object) array("letterFile" => "feedback.txt", 
                            "subject" => "Postscanner - форма обратной связи", 
                            "listId" => "2f028d8428",
                            "email" => $_POST['email']);
    send_letter_with_subject($args); 
    $args = (object) array("letter" => 'Имя: '.$_POST['name'].'<br>'.'Email: '.$_POST['email'].'<br>'.'<br>'.'Сообщение:'.'<br>'.$_POST['text'], 
                            "subject" => "Обратная связь - ".$_POST['name'], 
                            "listId" => "2f028d8428",
                            "email" => "info@postscanner.ru",
                            "email_type" => 'html');
    send_letter_with_subject($args); 
}

function send_subscribe() {
    $args = (object) array("letterFile" => "subscribe.txt", 
                            "subject" => "Postscanner - подписка", 
                            "listId" => "1decf300fc",
                            "email" => $_POST['email']);
    send_letter_with_subject($args); 
}

function send_letter_with_subject($args) {
    global $apiKey;
    $master = new Mailchimp($apiKey);
    $campaigns = new Mailchimp_Campaigns($master);
    $lists = new Mailchimp_Lists($master);

    $double_optin = false;
    $send_welcome = false;
    if (isset($args->email_type)) {
        $email_type = $args->email_type;
    } else {
        $email_type = 'html';
    }
    $email = $args->email;
    // $email = 'textmeback12012014@yandex.ru';
    // $merge_vars = array( 'YNAME' => $_POST['yname'] );
    $merge_vars = array( 'YNAME' => '123');

    $options = array('list_id' => $args->listId, 'subject' => $args->subject, 'from_email' => 'info@postscanner.ru', 'from_name' => 'Postscanner');
    if (strlen($args->letterFile) > 0) {
        $content = array('html' => file_get_contents(dirname(__FILE__).'/'.$args->letterFile));
    } else {
        $content = array('html' => $args->letter);
    }
    try {
        $result = $lists->subscribe($args->listId, array("email" => $email, "euid" => 0, "leid" => 0), $merge_vars, $email_type, $double_optin, true, true, $send_welcome);
        $segment = $lists->staticSegmentAdd($args->listId, $email.time());
        $users = array(0 => $result);
        $result = $lists->staticSegmentMembersAdd($args->listId, $segment["id"], $users);
        $result = $campaigns->create('regular', $options, $content, array("saved_segment_id" => $segment["id"]));
        $result = $campaigns->send($result["id"]);
    } catch (Exception $e) {
        echo $e.PHP_EOL;
        exit();
    }
}

