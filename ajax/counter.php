<?
//print_r($_REQUEST);
error_reporting(E_ALL^E_NOTICE);
$db = new mysqli("localhost", "ps", "psmysql01", "agregator");
if (mysqli_connect_errno())
{
    die("Подключение к серверу MySQL невозможно. Код ошибки: %s\n". mysqli_connect_error());
}
$db->set_charset("utf8");
$dateTime=date("Y-m-d H:i:s");

foreach($_REQUEST as $key => $value)
{
    $$key=str_replace(array('"',"'","`"),"_",$value);
}
$query="INSERT INTO `agregator`.`counter` (`ID`, `DESCRIPTION`, `IPADDRESS`, `DATE_INS`) VALUES (NULL, '$description', '{$_SERVER['REMOTE_ADDR']}', '$dateTime')";
error_reporting(E_ALL);
//$query=iconv('cp1252', 'utf-8', $query);



//print_r($query);
$res=$db->query($query);