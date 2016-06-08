<?php

	function getDim($volume) {
		return pow($volume, 1.0/3);
	}
	if (!@$argv)
    {
        $argv[1]="Москва";//$_REQUEST['cityf'];
    
        $argv[2]="Владивосток";//$_REQUEST['cityt'];
        
        $argv[3]=3;
        
        $argv[4]=0.000001;
        
        $argv[5]=25;
        
        $argv[6]=15;
    
    }
	list($originalCity) = split(',', $argv[1]);
	list($deliveryCity) = split(',', $argv[2]);
	$weight = $argv[3];
	$volume = $argv[4];
	$size = getDim($volume);
	$value = $argv[5];
	$date = getdate();
	$date = $date['year'].'-'.$date['mon'].'-'.$date['mday'];
	
	
	$originalCity = str_replace('Москва', 'Москва Восток', $originalCity);
	$deliveryCity = str_replace('Москва', 'Москва Восток', $deliveryCity);

	// Подключение файла с классом
	require_once('pecom_kabinet.php');

	// Создание экземпляра класса
	$sdk = new PecomKabinet('Savartem', 'D799BAA18E3E6BB2EC9D92859D7FD2BAAC81AA9C');

	// Вызов метода
	$result = $sdk->call('branches', 'findbytitle', 
		array(
			'title' => $originalCity
		)
	);
	// Вывод результата
	$originalCity = $result->items[0]->branchId; 
	
	// Вызов метода
	$result = $sdk->call('branches', 'findbytitle', 
		array(
			'title' => $deliveryCity
		)
	);
	// Вывод результата
	$deliveryCity = $result->items[0]->branchId; 
	
	if ($originalCity == $deliveryCity) {
		exit;
	}
    
    
    
   	$arTypes=array(array(false,false, "От склада до склада", 'transporting'),array(true,false, "От двери до склада", 'transportingWithPickup'),array(false,true, "От склада до двери",'transportingWithDelivery'),array(true,true, "От двери до двери",'transportingWithDeliveryWithPickup'));
    
    foreach($arTypes as $type)
    {
       
	// Вызов метода
	$result = $sdk->call('calculator', 'calculateprice', 
		array(
		   'senderCityId' => $originalCity, // Код города отправителя [Number]
		   'receiverCityId' => $deliveryCity, // Код города получателя [Number]
		   'isOpenCarSender' => false, // Растентовка отправителя [Boolean]
		   'senderDistanceType' => 0, // Тип доп. услуг отправителя [Number]
									// 0 - доп. услуги не нужны
									// 1 - СК
									// 2 - МОЖД
									// 3 - ТТК
		   'isDayByDay' => false, // Необходим забор день в день [Boolean]
		   'isOpenCarReceiver' => false, // Растентовка получателя [Boolean]
		   'receiverDistanceType' => 0, // Тип доп. услуг отправителя [Number]
									  // кодируется аналогично senderDistanceType
		   'isHyperMarket' => false, // признак гипермаркета [Boolean]
		   'calcDate' => $date, // расчетная дата [Date]
		   'isInsurance' => false, // Страхование [Boolean]
		   'isInsurancePrice' => $value, // Оценочная стоимость, руб [Number]
		   'isPickUp' => $type[0], // Нужен забор [Boolean]
		   'isDelivery' => $type[1], // Нужна доставка [Boolean]
		   'Cargos'=> array( // Данные о грузах [Array]
			  
			  array('length' => $size, // Длина груза, м [Number]
				  'width' => $size, // Ширина груза, м [Number]
				  'height' => $size, // Высота груза, м [Number]
				  'volume' => $size * $size * $size, // Объем груза, м3 [Number]
				  'maxSize' => $size, // Максимальный габарит, м [Number]
				  'isHP' => false, // Жесткая упаковка [Boolean]
				  'sealingPositionsCount' => 0, // Количество мест для пломбировки [Number]
				  'weight' => $weight, // Вес, кг [Number]
				  'overSize' => false // Негабаритный груз [Boolean]
			  )
			)
		)
		
	);
	printr($result);	
	// Вывод результата	
	if ($result->hasError == NULL) {
		if ($result->transfers[0]->hasError == false) {
			list($price) = split(',', (string)$result->transfers[0]->costTotal);
			$output= array('price' => (string)$price, 'time' => 'Уточните у перевозчика', 'condition' => 'Автоперевозка. '.$type[2]);
			printr($output);
           // echo json_encode($output). PHP_EOL;	
		}
		
		if ($result->transfers[1]->hasError == false) {
			list($price) = split(',', (string)$result->transfers[1]->costTotal);
            
           
            
			$output= array('price' => (string)$price, 'time' => getTime($result->commonTerms[0],$type[3]), 'condition' => 'Авиаперевозка. '.$type[2]);
			printr($output);
          //  echo json_encode($output). PHP_EOL;	
		}
	}
	}
	// Освобождение ресурсов
	$sdk->close();
    function getTime($delivery, $type)
    {
        if (!$delivery->$type)
            return 'Уточните у перевозчика';
        if (is_array($delivery->$type))
        {
            $arTerm=$delivery->$type;
            return (string)$arTerm[0].' дн.';
        }
        else
            return (string)$delivery->$type.' дн.';
    }
    function vardump($obj)
{
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';        
    
}
    function printr($obj)
{
    echo '<pre>';
    print_r($obj);
    echo '</pre>';        
    
}
?>