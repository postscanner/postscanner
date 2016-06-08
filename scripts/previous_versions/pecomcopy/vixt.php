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
		$s=json_decode(file_get_contents('http://kladr-api.ru/api.php?query=город '.$t.'&typeCode=1&contentType=city&oneString=1&limit=1&withParent=1&typeCode=1'));	
 #print_r($s);		
		$s=substr($s->result[0]->id,0,11) ;
		return $s;
	}
	
	function curlEx($x){
		$curl = curl_init();
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt( $curl, CURLOPT_POST, 1);	
		curl_setopt( $curl, CURLOPT_URL, 'http://90.156.152.6/Aggregators/Orders.asmx');
		curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type: application/soap+xml'));
		curl_setopt( $curl, CURLOPT_POSTFIELDS,   $x);
		$auth = curl_exec( $curl );
		curl_close( $curl );
		return gDom($auth);
	}
	
	
	
	list($originalCity) = split(',', $argv[1]);
	list($deliveryCity) = split(',', $argv[2]);
	$wweight = str_replace (",",".",$argv[3]); # вес в кг
	$volume = str_replace (",",".",$argv[4]);# объём в м3
	$size = getDim($volume); # средняя стороны
	$value = str_replace (",",".",$argv[5]); # стоимость	
	$originalCity= kladr($originalCity);
	$deliveryCity= kladr($deliveryCity);
	/*
	$xml = '

    ';
	$=curlEx($xml);
	*/
		
	$result=gDom(file_get_contents('http://90.156.152.6/Aggregators/Orders.asmx/GetGeneralInfo?townToKladrCode='.$deliveryCity.'&townFromKladrCode='.$originalCity.'&weight='.$wweight.'&objectsQty=1&payType=3&payerType=0&versionNo=1&aggregator=Postscanner&sessionID='));

	
print_r($result);
if ($result[0]!= '') {
		foreach ($result as $v){

			$t=ceil($v->DeliveryDuration/24);
			$r=floor ($v->DeliveryDuration/24);
			if ($r==0)  $r=1;
			if ($t==0)  $t=1;
			if ($t!=$r) $t=$t.'-'.$r;
			
			#чтобы сделать доставку не в днях, а часа, удаляй 5 строк выше расскомментируй одну ниже. снизу вставь рядом с $t.' ч.'
			#$t= $v->DeliveryDuration; 
			
			$output= array('price' => round($v->CostTotalRub), 'time' => $t, 'condition' =>$v->Note.' '.$v->ServiceTitle.'. '.$v->VarZonesList);
			echo json_encode($output). PHP_EOL;
		}
	}
		

?>