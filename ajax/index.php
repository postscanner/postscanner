<?
die();
error_reporting(E_ALL^E_NOTICE^E_DEPRECATED);
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
  $Mailer->AddAddress('dmitriy.supov@gmail.com');
  $Mailer->AddBCC('s_dimon88@list.ru');
  $subject = "Заказ с сайта postscanner.ru";
  $Mailer->Subject = $subject;
  $message="blablabla";
  $Mailer->Body = $message;
  
  
 if($Mailer->Send()) echo 'true'; else echo 'false';
die('4');
 
die();



//phpinfo();
$headers='';
//$tomail='s-dimon88@yandex.ru';
//$tomail='s_dimon88@list.ru';
$subject = "Заказ с сайта postscanner.ru";
//$headers .= "From: Postscanner.ru <info@postscanner.ru>\r\n";

$message = "
Откуда: бла бла бла \r\n
*стоимость доставки предварительная, финальная стоимость подлежит согласованию с оператором.
";

//mail('dmitriy.supov@gmail.com', $subject, $message, $headers); 
?>