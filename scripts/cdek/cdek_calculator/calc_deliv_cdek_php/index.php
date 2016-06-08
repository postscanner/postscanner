<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

echo '
<!DOCTYPE html>
<html>
 <head>
  <title>description</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
 </head> 
 <body>';

echo "<br />Данные из формы: <br /><pre>";
var_dump($_REQUEST);
echo "</pre>";

//подключаем файл с классом CalculatePriceDeliveryCdek
include_once("CalculatePriceDeliveryCdek.php");

try {

	//создаём экземпляр объекта CalculatePriceDeliveryCdek
	$calc = new CalculatePriceDeliveryCdek();
	
    //Авторизация. Для получения логина/пароля (в т.ч. тестового) обратитесь к разработчикам СДЭК -->
    //$calc->setAuth('authLoginString', 'passwordString');
	
	//устанавливаем город-отправитель
	$calc->setSenderCityId(270);
	//устанавливаем город-получатель
	$calc->setReceiverCityId(270);
	//устанавливаем дату планируемой отправки
//	$calc->setDateExecute(data('Y-m-d'));
	
	//устанавливаем тариф по-умолчанию
	$calc->setTariffId('10');
	//задаём список тарифов с приоритетами
    // $calc->addTariffPriority($_REQUEST['tariffList1']);
    // $calc->addTariffPriority($_REQUEST['tariffList2']);
	
	
	//устанавливаем режим доставки
	$calc->setModeDeliveryId(3);
	//добавляем места в отправление
	$calc->addGoodsItemByVolume(10, 0.1);
	
	if ($calc->calculate() === true) {
		$res = $calc->getResult();
		
		echo 'Цена доставки: ' . $res['result']['price'] . 'руб.<br />';
		echo 'Срок доставки: ' . $res['result']['deliveryPeriodMin'] . '-' . 
								 $res['result']['deliveryPeriodMax'] . ' дн.<br />';
		echo 'Планируемая дата доставки: c ' . $res['result']['deliveryDateMin'] . ' по ' . $res['result']['deliveryDateMax'] . '.<br />';
		echo 'id тарифа, по которому произведён расчёт: ' . $res['result']['tariffId'] . '.<br />';
        if(array_key_exists('cashOnDelivery', $res['result'])) {
            echo 'Ограничение оплаты наличными, от (руб): ' . $res['result']['cashOnDelivery'] . '.<br />';
        }
	} else {
		$err = $calc->getError();
		if( isset($err['error']) && !empty($err) ) {
			//var_dump($err);
			foreach($err['error'] as $e) {
				echo 'Код ошибки: ' . $e['code'] . '.<br />';
				echo 'Текст ошибки: ' . $e['text'] . '.<br />';
			}
		}
	}
    
    //раскомментируйте, чтобы просмотреть исходный ответ сервера
    // var_dump($calc->getResult());
    // var_dump($calc->getError());

} catch (Exception $e) {
    echo 'Ошибка: ' . $e->getMessage() . "<br />";
}


echo '
  </body>
</html>
';

?>