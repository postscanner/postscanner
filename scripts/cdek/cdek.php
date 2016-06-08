<?
error_reporting(E_ALL);
//echo 'test';
include('cdek_arrays.php');
include_once("CalculatePriceDeliveryCdek.php");
//printr($arTarif);

if (!@$argv)
{
    $argv[1]="Воронеж";//$_REQUEST['cityf'];

    $argv[2]="Саратов";//$_REQUEST['cityt'];
    
    $argv[3]=$_REQUEST['weight'];
    
    $argv[4]=$_REQUEST['volume'];
    
    //$argv[5]=$_REQUEST['value'];

}
$side=round(pow($argv[4]*1000000, 1.0/3));
//printr($side);
try {

	//создаём экземпляр объекта CalculatePriceDeliveryCdek
	$calc = new CalculatePriceDeliveryCdek();
	
    //Авторизация. Для получения логина/пароля (в т.ч. тестового) обратитесь к разработчикам СДЭК -->
    //$calc->setAuth('authLoginString', 'passwordString');
		
	//устанавливаем город-отправитель
	$calc->setSenderCityId($arCity[$argv[1]]);
	//устанавливаем город-получатель
	$calc->setReceiverCityId($arCity[$argv[2]]);
	//устанавливаем дату планируемой отправки
	//echo $arCity['Москва'];
	//устанавливаем тариф по-умолчанию
	//$calc->setTariffId('1');
	//задаём список тарифов с приоритетами
    // $calc->addTariffPriority($_REQUEST['tariffList1']);
    // $calc->addTariffPriority($_REQUEST['tariffList2']);
	
	
	//устанавливаем режим доставки
	//добавляем места в отправление
	//$calc->addGoodsItemBySize(11, 111,50, 131);
    $calc->addGoodsItemBySize($argv[3], round($argv[5]),round($argv[6]),round($argv[7]));
	
	//$calc->addGoodsItemByVolume($argv[3],$argv[4]);
	foreach($arTarif as $key => $item)
    {
        
        $calc->setTariffId($key);
    	if ($calc->calculate() === true) {
    		$res = $calc->getResult();
    		
    		/*echo 'Цена доставки: ' . $res['result']['price'] . 'руб.<br />';
    		echo 'Срок доставки: ' . $res['result']['deliveryPeriodMin'] . '-' . 
    								 $res['result']['deliveryPeriodMax'] . ' дн.<br />';
    		echo 'Планируемая дата доставки: c ' . $res['result']['deliveryDateMin'] . ' по ' . $res['result']['deliveryDateMax'] . '.<br />';
    		echo 'id тарифа, по которому произведён расчёт: ' . $res['result']['tariffId'] . '.<br />';
            if(array_key_exists('cashOnDelivery', $res['result'])) {
                echo 'Ограничение оплаты наличными, от (руб): ' . $res['result']['cashOnDelivery'] . '.<br />';
            }*/
            $output= array('price' => $res['result']['price'], 'time' => $res['result']['deliveryPeriodMin'] . '-' . $res['result']['deliveryPeriodMax'] . ' дн.', 'condition' => $item['decription'].$item['condition']);
            //printr($output);
            echo json_encode($output). PHP_EOL;
    	} else {
    		/*$err = $calc->getError();
    		if( isset($err['error']) && !empty($err) ) {
    			//var_dump($err);
    			foreach($err['error'] as $e) {
    				echo 'Код ошибки: ' . $e['code'] . '.<br />';
    				echo 'Текст ошибки: ' . $e['text'] . '.<br />';
    			}
    		}*/
    	}
    }
    //раскомментируйте, чтобы просмотреть исходный ответ сервера
    // var_dump($calc->getResult());
    // var_dump($calc->getError());

} catch (Exception $e) {
    echo 'Ошибка: ' . $e->getMessage() . "<br />";
}




function printr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}