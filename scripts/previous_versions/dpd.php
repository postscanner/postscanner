<?php	
/**
 *@soap
 */
	function getDim($volume) {
		return pow($volume, 1.0/3);
	}
	function gDom ($d){
		$dom = new DomDocument;
		$dom->loadXML($d);
		return simplexml_import_dom($dom);
	}
 
	list($originalCity) = split(',', $argv[1]);
	list($deliveryCity) = split(',', $argv[2]);
	$wweight = $argv[3];
	$volume = $argv[4];
	$size = getDim($volume);
	$value = $argv[5];

	$client = new SoapClient("http://ws.dpd.ru/services/calculator2?wsdl");
	 
	
	$au= array(
		'request'=>array(
			'auth'=>array(
				'clientNumber' => '1001035445',
				'clientKey' => 'EF80DEC02A1784E8FC924D55A7A9689C76948BC2'
				),
			'pickup'=>array(
				'cityName'=>$originalCity),
			'delivery'=>array(
				'cityName'=>$deliveryCity),
			'selfPickup'=>true,
			'selfDelivery'=>true,
			'weight'=>str_replace (',','.',$wweight),
			'volume'=>str_replace (',','.',$volume),
			'declaredValue'=>str_replace (',','.',$value)
		));
	
$a2= array(
		'request'=>array(
			'auth'=>array(
				'clientNumber' => '1001035445',
				'clientKey' => 'EF80DEC02A1784E8FC924D55A7A9689C76948BC2'
				),
			'pickup'=>array(
				'cityName'=>$originalCity),
			'delivery'=>array(
				'cityName'=>$deliveryCity),
			'selfPickup'=>false,
			'selfDelivery'=>true,
			'weight'=>str_replace (',','.',$wweight),
			'volume'=>str_replace (',','.',$volume),
			'declaredValue'=>str_replace (',','.',$value)
		));	
		
	$a3= array(
		'request'=>array(
			'auth'=>array(
				'clientNumber' => '1001035445',
				'clientKey' => 'EF80DEC02A1784E8FC924D55A7A9689C76948BC2'
				),
			'pickup'=>array(
				'cityName'=>$originalCity),
			'delivery'=>array(
				'cityName'=>$deliveryCity),
			'selfPickup'=>true,
			'selfDelivery'=>false,
			'weight'=>str_replace (',','.',$wweight),
			'volume'=>str_replace (',','.',$volume),
			'declaredValue'=>str_replace (',','.',$value)
		));	
		
$a4= array(
		'request'=>array(
			'auth'=>array(
				'clientNumber' => '1001035445',
				'clientKey' => 'EF80DEC02A1784E8FC924D55A7A9689C76948BC2'
				),
			'pickup'=>array(
				'cityName'=>$originalCity),
			'delivery'=>array(
				'cityName'=>$deliveryCity),
			'selfPickup'=>false,
			'selfDelivery'=>false,
			'weight'=>str_replace (',','.',$wweight),
			'volume'=>str_replace (',','.',$volume),
			'declaredValue'=>str_replace (',','.',$value)
		));		
		
		
	$error = 0;

    try { 
		$r1 = $client->__call('getServiceCost2',array($au));
	} catch (SoapFault $fault) { 
            $error = 1; 
    } if ($error==0){
		$result= $r1->return;
		$ans+=1;
	}
	
	$error = 0;
	$ans=0;
    try { 
		$r2 = $client->__call('getServiceCost2',array($a2));
	} catch (SoapFault $fault) { 
            $error = 1; 
    } if ($error==0){
		if (is_array($result)){
		$result= array_merge ($result,$r2->return);
		} else {
			$result=$r2->return;
		}
		$ans+=1;
	}
	
	$error = 0;
    try { 
		$r3 = $client->__call('getServiceCost2',array($a3));
	} catch (SoapFault $fault) { 
            $error = 1; 
    } if ($error==0){
		if (is_array($result)){
		$result= array_merge ($result,$r3->return);
		} else {
			$result=$r3->return;
		}
		$ans+=1;
	}
	
	$error = 0;
    try { 
		$r4 = $client->__call('getServiceCost2',array($a4));
	} catch (SoapFault $fault) { 
            $error = 1; 
    } if ($error==0){
		if (is_array($result)){
		$result= array_merge ($result,$r4->return);
		} else {
			$result=$r4->return;
		}
		$ans+=1;
	}

	if ($ans>0) { 
	$result= array_unique($result,SORT_REGULAR );
		foreach ($result as $v){
				echo json_encode(array('price' => round($v->cost), 'time' => $v->days, 'condition' =>$v->serviceName)).PHP_EOL;
			}
	}
?>