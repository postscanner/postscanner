<?
if (!$_REQUEST['usrname']||!$_REQUEST['email']||!$_REQUEST['phone'])
    die();
foreach($_REQUEST as $key => $value)
{
    $$key=$value;
}
//print_r($_REQUEST);
error_reporting(E_ALL^E_NOTICE);
$db = new mysqli("localhost", "ps", "psmysql01", "agregator");
if (mysqli_connect_errno())
{
    die("Подключение к серверу MySQL невозможно. Код ошибки: %s\n". mysqli_connect_error());
}
$db->set_charset("utf8");
$dateTime=date("Y-m-d H:i:s");


require_once('../pm/class.phpmailer.php');
require_once('../pm/class.smtp.php');
$Mailer = new PHPMailer();
//$Mailer->SMTPDebug = 1;
$Mailer->CharSet = 'UTF-8';
$Mailer->IsSMTP();
$Mailer->Host = 'smtp.yandex.ru';
$Mailer->Port = 25;
$Mailer->SMTPAuth = true;
$Mailer->Username = 'info@postscanner.ru';
$Mailer->Password = 'postscannersite';

$Mailer->SetFrom('info@postscanner.ru', 'Postscanner');
$Mailer->AddAddress($email);
$Mailer->AddBCC('dmitriy.supov@gmail.com');
$subject = "Заказ с сайта postscanner.ru";
$Mailer->Subject = $subject;
$message = "
Спасибо за ваш заказ!\r\n
Откуда: $from \r\n
Куда: $to  \r\n
Вес: $weight \r\n
Размер (ДхШхВ): $volume \r\n
Страховая стоимость: $svalue \r\n
Служба доставки: $compname \r\n
Тим доставки: $condition \r\n
Стоимость доставки: $price \r\n
Срок доставки: $srok * \r\n
Комментарий: $comment \r\n
*стоимость доставки предварительная, финальная стоимость подлежит согласованию с оператором.
";
$Mailer->Body = $message;
$Mailer->Send();



$tomail  = $comail ;





$Mailer = new PHPMailer();
//$Mailer->SMTPDebug = 1;
$Mailer->CharSet = 'UTF-8';
$Mailer->IsSMTP();
$Mailer->Host = 'smtp.yandex.ru';
$Mailer->Port = 25;
$Mailer->SMTPAuth = true;
$Mailer->Username = 'info@postscanner.ru';
$Mailer->Password = 'postscannersite';

$Mailer->SetFrom('info@postscanner.ru', 'Postscanner');
$Mailer->AddAddress($tomail);
$Mailer->AddBCC('dmitriy.supov@gmail.com');
if ($tomail!='info@postscanner.ru')
    $Mailer->AddBCC('info@postscanner.ru');
$subject = "Заказ с сайта postscanner.ru";
$Mailer->Subject = $subject;

//print_r($svalue);
$message = "
Имя: $usrname \r\n 
Email: $email \r\n
Телефон: $phone \r\n
Откуда: $from \r\n
Куда: $to  \r\n
Вес: $weight \r\n
Размер (ДхШхВ): $volume \r\n
Страховая стоимость: $svalue руб. \r\n
Служба доставки: $compname \r\n
Тим доставки: $condition \r\n
Стоимость доставки: $price руб. \r\n
Срок доставки: $srok \r\n
Комментарий: $comment \r\n
";

$Mailer->Body = $message;
$Mailer->Send();

require('../letters/newsletter.php');

$args = (object) array("content" => $message, 
                            "subject" => "Заказ с сайта postscanner.ru", 
                            "listId" => "9cac6aedb5",
                            "email" => $tomail);
$args1 = (object) array("content" => 'test', 
                            "subject" => "Заказ с сайта postscanner.ru", 
                            "listId" => "",
                            "email" => 's_dimon88@list.ru');
//send_subscribe();
//send_email($args);

foreach($_REQUEST as $key => $value)
{
    $$key=str_replace(array('"',"'","`"),"_",$value);
}
$query="INSERT INTO `agregator`.`orders` (`ID`, `USRNAME`, `PHONE`, `EMAIL`, `COMPANY`, `CITYFROM`, `CITYTO`,`WEIGHT`, `VALUE`, `VOLUME`, `CNTPRICE`,`SROK`, `SHIPMENTTYPE`, `DATE`,`COMMENT`) VALUES (NULL, '$usrname', '$phone', '$email', '$compname', '$from', '$to', '$weight', '$value', '$volume', '$price','$srok', '$condition', '$dateTime', '$comment')";

//$query=iconv('cp1252', 'utf-8', $query);



//print_r($query);
$res=$db->query($query);


function printr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}
//mail($comail,'заказ',$usrname.' '.$email.' '.$phone);
?>