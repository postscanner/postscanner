<?php	
	
	function kladr ($t){
		$s=json_decode(file_get_contents('http://kladr-api.ru/api.php?query=город '.$t.'&typeCode=1&contentType=city&oneString=1&limit=1&withParent=1&typeCode=1'));	
#print_r($s);		
		$s=$s->result[0]->id.str_repeat("0", 25-strlen ($s->result[0]->id));
		return $s;
	}
	if (!@$argv)
    {
        $argv[1]="Воронеж";//$_REQUEST['cityf'];
    
        $argv[2]="Саратов";//$_REQUEST['cityt'];
        
        $argv[3]=1;
        
        $argv[4]=1;
        
        $argv[5]=25;
        
        $argv[6]=15;
    
    }
	list($originalCity) = split(',', $argv[1]);
	list($deliveryCity) = split(',', $argv[2]);
	$wweight = $argv[3]; # вес в кг
	$volume = $argv[4];# объём в м3
	$value = $argv[5]; # стоимость
	$originalCity= kladr($originalCity);
	$deliveryCity= kladr($deliveryCity);	
	
	$arTypes=array(array(false,false, "От терминала до терминала"),array(true,false, "От двери до терминала"),array(false,true, "От терминала до двери"),array(true,true, "От двери до двери"));
    
    foreach($arTypes as $type)
    {
        
    
    
    	$outt=json_encode(ARRAY(
    		"appKey"=> "943CB236-ED90-11E4-8F8A-00505683A6D3", 
    		"derivalPoint" => $originalCity, 
    		"derivalDoor" =>  $type[0], 
    		"arrivalPoint" => $deliveryCity, 
    		"arrivalDoor" =>  $type[1], 
    		"sizedVolume" =>  $volume,
    		"sizedWeight" =>  $wweight,
    		"statedValue" =>  $value
    		));
    		
    		
    		$curl = curl_init('https://api.dellin.ru/v1/public/calculator.json');
    		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
    		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
    		curl_setopt( $curl, CURLOPT_POST, 1);	
    		curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    		curl_setopt( $curl, CURLOPT_POSTFIELDS,  $outt);
    		$outt = curl_exec( $curl );
    		curl_close( $curl );
    		$result=json_decode($outt);
    	//	printr($result);
    		
    		#print_r($result);#'    '.$originalCity.'    '.$deliveryCity );
    		
    	if ($result->errors == NULL) {
    			$output= array('price' => (string)round($result->price), 'time' => $result->time->value, 'condition' =>$type[2].' (Наземный способ)');
    			echo json_encode($output). PHP_EOL;
    			if( $result->air!=NULL)echo json_encode(array('price' => (string)round($result->derival->price + $result->air->price), 'time' => $result->time->value, 'condition' =>$type[2].' (Авиаперевозка)')).PHP_EOL;
    	}
	}
    
    
    
    
    
    
    
function printr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}
?>