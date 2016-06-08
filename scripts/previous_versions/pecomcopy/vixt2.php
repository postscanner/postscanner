<?php	

	function getDim($volume) {
		return pow($volume, 1.0/3);
	}
	
	function gDom ($d){
		$dom = new DomDocument;
		$dom->loadXML($d);
		return simplexml_import_dom($dom);
	}
	
	function kladr ($t){
		$s=json_decode(file_get_contents('http://kladr-api.ru/api.php?query='.$t.'&oneString=1&limit=1&withParent=1'));
		return $s->result[0]->id;
	}
	function curlEx($x){
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt( $curl, CURLOPT_POST, 1);	
		curl_setopt( $curl, CURLOPT_URL, 'http://api.spsr.ru:8020/waExec/WAExec');
		curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
		curl_setopt( $curl, CURLOPT_POSTFIELDS,   $x);
		$auth = curl_exec( $curl );
		curl_close( $curl );
		return gDom($auth);
	}
	
	list($originalCity) = split(',', $argv[1]);
	list($deliveryCity) = split(',', $argv[2]);
	$wweight = $argv[3]; # גוס ג ךד
	$volume = $argv[4];# מבת¸ל ג ל3
	$size = getDim($volume); # סנוהם סעמנמם
	$value = $argv[5]; # סעמטלמסע	
	$originalCity= kladr($originalCity);
	$deliveryCity= kladr($deliveryCity);	
	/*
	$xml = '

    ';
	$=curlEx($xml);
	*/
	
$res= file_get_contents('http://90.156.152.6/Aggregators/Orders.asmx/GetGeneralInfo?townFromKladrCode='.$originalCity.'&townToKladrCode='.$deliveryCity.'&weight=string&objectsQty='.$wweight.'&payType=0&payerType=0&versionNo=1&aggregator=Postscanner&sessionID=0');	
	
	


	
	
print_r($res)
		

?>