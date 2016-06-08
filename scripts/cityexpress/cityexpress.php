<?


	
	/*function kladr ($t){
		$s=json_decode(file_get_contents('http://kladr-api.ru/api.php?query=город '.$t.'&typeCode=1&contentType=city&oneString=1&limit=1&withParent=1&typeCode=1'));	
#print_r($s);		
		$s=$s->result[0]->id.str_repeat("0", 25-strlen ($s->result[0]->id));
		return $s;
	}
	*/
	if (!@$argv)
    {
        $argv[1]="Воронеж";//$_REQUEST['cityf'];
    
        $argv[2]="Саратов";//$_REQUEST['cityt'];
        
        $argv[3]=1;
        
        $argv[4]=30;
        
        $argv[5]=25;
        
        $argv[6]=15;
    
    }
   
	
    $cityFrom = $argv[1];
	$cityTo= $argv[2];
	$physicalWeight = str_replace(',','.',$argv[3]);; # вес в кг
	$width=$argv[4];
    $height=$argv[5];
	$length=$argv[6];
	
	
	
	   $address="http://api.cityexpress.ru/v1/7F94DF53C42A5BE7B9F4F24054411223/Calculate?cityFrom=$cityFrom&cityTo=$cityTo&physicalWeight=$physicalWeight&width=$width&height=$height&length=$length&quantity=1";
       //$address="http://postscanner.ru/scripts/cityexpress/?cityFrom=$cityFrom&cityTo=$cityTo&physicalWeight=$physicalWeight&width=$width&height=$height&length=$length&quantity=1";
       //printr($address);
		//'Content-Type: application/json'
		$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $address);
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); 
		curl_setopt( $curl, CURLOPT_HTTPHEADER, array('Accept: application/json')); 
		$outt = curl_exec( $curl );
		curl_close( $curl );
		$res=json_decode($outt);
	
		$arResult=$res->Result;
		#print_r($result);#'    '.$originalCity.'    '.$deliveryCity );
		foreach($arResult as $result)
	    {
			$output= array('price' => (string)round($result->TotalPrice), 'time' => $result->DeliveryTime, 'condition' =>$result->Name);
			echo json_encode($output). PHP_EOL;
		}
	


function printr($arr)
{
    echo '<pre>';
    print_r($arr);
    echo '</pre>';
}
?>