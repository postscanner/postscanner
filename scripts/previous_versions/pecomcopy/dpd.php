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
	
        try { 
	
	$result = $client->__call('getServiceCost2',array($au));
	 } catch (SoapFault $fault) { 
            $error = 1; 
           # print( $fault->faultcode."-".$fault->faultstring." 
            # "); 
        } 
	if ($error == 0) {    
	
	foreach ($result->return as $v){
			$output= array('price' => round($v->cost), 'time' => $v->days, 'condition' =>$v->serviceName);
			echo json_encode($output). PHP_EOL;
		}
	
	
	}
		

?>