<?php	

	function getDim($volume) {
		return pow($volume, 1.0/3);
	}

	list($originalCity) = split(',', $argv[1]);
	list($deliveryCity) = split(',', $argv[2]);
	$wweight = $argv[3];
	$volume = $argv[4];
	$size = getDim($volume);
	$value = $argv[5];

	$originalCity = str_replace('Москва', 'Москва Восток', $originalCity);
	$deliveryCity = str_replace('Москва', 'Москва Восток', $deliveryCity);

	$client = new SoapClient(NULL,  
        array(  
        "location" => "http://90.156.152.6/Aggregators/Orders.asmx"
		));  

	$result = $client->GetGeneralInfo()

	
print_r($result)
		

?>