<?php	
    if (@$_REQUEST["debug"]==1)
       { //echo tesr;
        error_reporting(E_ALL^E_NOTICE^E_DEPRECATED);}
   // print_r($test); der();
  //  die(ggh);
	function getDim($volume) {
		return pow($volume, 1.0/3);
	}
	
	function gDom ($d){
		$dom = new DomDocument;
		$dom->loadXML($d);
		return simplexml_import_dom($dom);
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
   // print_r($_REQUEST);
	if (!@$argv)
    {$argv[1]="Воронеж";//$_REQUEST['cityf'];

$argv[2]="Саратов";//$_REQUEST['cityt'];

$argv[3]=$_REQUEST['weight'];

$argv[4]=$_REQUEST['volume'];

$argv[5]=$_REQUEST['value'];

}
       // $argv=$_REQUEST;
	list($originalCity) = split(',', $argv[1]);
	list($deliveryCity) = split(',', $argv[2]);
	$wweight = $argv[3]; # вес в кг
	$volume = $argv[4];# объём в м3
	$size = getDim($volume); # средняя стороны
	$value = $argv[5]; # стоимость
 if (@$_REQUEST["debug"]==1)
    echo $size;
	//наши данные	
	$login='test';
	$pass='test';

//работа с курлом		
	$xml = '
	<root xmlns="http://spsr.ru/webapi/usermanagment/login/1.0">
		<p:Params Name="WALogin" Ver="1.0" xmlns:p="http://spsr.ru/webapi/WA/1.0" />
			<Login Login="'.$login.'" Pass="'.$pass.'" UserAgent="Postscanner"/>
	</root>
    ';
	$auth=curlEx($xml);

	/*
	$xml = '

    ';
	$=curlEx($xml);
	*/
	
	$xml = '
	<root xmlns="http://spsr.ru/webapi/Info/GetCities/1.0"> 
		<p:Params Name="WAGetCities" Ver="1.0" xmlns:p="http://spsr.ru/webapi/WA/1.0" /> 
		<GetCities CityName="'.$originalCity .'" /> 
	</root>
    ';
	$originalCity =curlEx($xml);	
	$originalCity=$originalCity->City->Cities['City_ID'];
	
	$xml = '
	<root xmlns="http://spsr.ru/webapi/Info/GetCities/1.0"> 
		<p:Params Name="WAGetCities" Ver="1.0" xmlns:p="http://spsr.ru/webapi/WA/1.0" /> 
		<GetCities CityName="'.$deliveryCity .'" /> 
	</root>
    ';
	$deliveryCity =curlEx($xml);	
	$deliveryCity=$deliveryCity->City->Cities['City_ID'];
	
$result= gDom(file_get_contents('http://www.cpcr.ru/cgi-bin/postxml.pl?TARIFFCOMPUTE_2&ToCity='.$deliveryCity.'|0&FromCity='.$originalCity.'|0&Weight='.$wweight.'&Amount='.$value.'&GabarythB='.(($size*3)>1.90)));	
	//vardump($result);	
	$xml = '<root xmlns="http://spsr.ru/webapi/usermanagment/logout/1.0" > 
	<p:Params Name="WALogout" Ver="1.0" xmlns:p="http://spsr.ru/webapi/WA/1.0" /> 
	<Logout Login="'.$login.'" SID="'.$auth->Login['SID'].'" /> 
	</root> ';
	curlEx($xml);		
    
	if ($result->Error == '') {
		foreach ($result->Tariff as $v){
			#if (strpos($v->TariffType,'Авиа')) $con='Авиаперевозка'; else $con='Автоперевозка';
			$output= array('price' => (string)$v->Total_Dost, 'time' => (string)$v->DP, 'condition' => (string)$v->TariffType);
			echo json_encode($output). PHP_EOL;
		}
	}
    else
    {
        echo '<pre>';
        var_dump($result->Error);        
            
    }        

function vardump($obj)
{
    echo '<pre>';
    var_dump($obj);
    echo '</pre>';        
    
}
?>