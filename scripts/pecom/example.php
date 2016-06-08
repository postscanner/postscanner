<?php	

function getDim($volume) {
    return pow($volume, 1.0/3);
}

	$originalCity = $argv[1];
	$deliveryCity = $argv[2];
	$weight = $argv[3];
	$volume = $argv[4];
	$size = getDim($volume);
	$value = $argv[5];

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
	var_dump($originalCity);
	
	// Вызов метода
	$result = $sdk->call('branches', 'findbytitle', 
		array(
			'title' => $deliveryCity
		)
	);
	// Вывод результата
	$deliveryCity = $result->items[0]->branchId; 
	var_dump($deliveryCity);

	
	
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
		   'calcDate' => '2014-01-21', // расчетная дата [Date]
		   'isInsurance' => true, // Страхование [Boolean]
		   'isInsurancePrice' => $value, // Оценочная стоимость, руб [Number]
		   'isPickUp' => false, // Нужен забор [Boolean]
		   'isDelivery' => false, // Нужна доставка [Boolean]
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
	
	// Вывод результата
	
	if ($result->hasError == NULL) {
		if ($result->transfers[0]->hasError == false) {
			list($price) = split(',', (string)$result->transfers[0]->costTotal);
			$output= array('price' => (string)$price, 'time' => 'Уточните у перевозчика', 'condition' => 'Автоперевозка');
			echo json_encode($output). PHP_EOL;	
		}
		
		if ($result->transfers[1]->hasError == false) {
			list($price) = split(',', (string)$result->transfers[1]->costTotal);
			$output= array('price' => (string)$price, 'time' => 'Уточните у перевозчика', 'condition' => 'Авиаперевозка');
			echo json_encode($output). PHP_EOL;	
		}
	}
	
	// Освобождение ресурсов
	$sdk->close();
?>