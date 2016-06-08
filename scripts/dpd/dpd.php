<?php	
/**
 *@soap
 */
 error_reporting(E_ALL);
	function getDim($volume) {
		return pow($volume, 1.0/3);
	}
	function gDom ($d){
		$dom = new DomDocument;
		$dom->loadXML($d);
		return simplexml_import_dom($dom);
	}
    
  
  if (!@$argv)
    {$argv[1]="Москва";//$_REQUEST['cityf'];

$argv[2]="Усть-кут";//$_REQUEST['cityt'];

$argv[3]=4; //$_REQUEST['weight'];

$argv[4]=0.005;//$_REQUEST['volume'];

$argv[5]=1000; //$_REQUEST['value'];
}
 
//printr($argv);
	list($originalCity) = split(',', $argv[1]);
	list($deliveryCity) = split(',', $argv[2]);
	$wweight = $argv[3];
	$volume = $argv[4];
	$size = getDim($volume);
	$value = $argv[5];

	$client = new SoapClient("http://ws.dpd.ru/services/calculator2?wsdl");
	 
    $arPick=array(
				'cityName'=>$originalCity);
    if ($originalCity=='Москва')
        $arPick['regionCode']='77';
     
    // printr($arPick);
     
     $arDeliv=array(
				'cityName'=>$deliveryCity);
    if ($deliveryCity=='Москва')
        $arDeliv['regionCode']='77';
	
	$au= array(
		'request'=>array(
			'auth'=>array(
				'clientNumber' => '1001035445',
				'clientKey' => 'EF80DEC02A1784E8FC924D55A7A9689C76948BC2'
				),
			'pickup'=>$arPick,
			'delivery'=>$arDeliv,
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
			'pickup'=>$arPick,
			'delivery'=>$arDeliv,
            'selfDelivery'=>true,
			'selfPickup'=>false,
			
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
			'pickup'=>$arPick,
			'delivery'=>$arDeliv,
            'selfDelivery'=>false,
			'selfPickup'=>true,
			
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
			'pickup'=>$arPick,
			'delivery'=>$arDeliv,
			'selfPickup'=>false,
			'selfDelivery'=>false,
			'weight'=>str_replace (',','.',$wweight),
			'volume'=>str_replace (',','.',$volume),
			'declaredValue'=>str_replace (',','.',$value)
		));		
		
	//	printr('test');
	$error = 0;
    $ans=0;
    try { 
		$r1 = $client->__call('getServiceCost2',array($au));
	} catch (SoapFault $fault) { 
	       vardump($fault);
            $error = 1; 
    } if ($error==0){
		$result['p-p']= $r1->return;
		$ans+=1;
	}
	//printr($result);
	$error = 0;
	$ans=0;
    try { 
		$r2 = $client->__call('getServiceCost2',array($a2));
	} catch (SoapFault $fault) { 
            $error = 1; 
    } if ($error==0){
		
			$result['p-d']=$r2->return;
		
		$ans+=1;
	}
	//printr($result);
	$error = 0;
    try { 
		$r3 = $client->__call('getServiceCost2',array($a3));
	} catch (SoapFault $fault) { 
            $error = 1; 
    } if ($error==0){
		
			$result['d-p']=$r3->return;
		
		$ans+=1;
	}
	
	$error = 0;
    try { 
		$r4 = $client->__call('getServiceCost2',array($a4));
	} catch (SoapFault $fault) { 
            $error = 1; 
    } if ($error==0){
		
			$result['d-d']=$r4->return;
		
        //printr($r4->return);
		$ans+=1;
	}

    //printr($result);
	if ($ans>0) { 
/*	foreach($result as $key => $arItems)
    {
        foreach($result as $key2 => $arItems2)
        {
            if ($key==$key2)
                continue;
            foreach($arItems as $index => $item)
            {
                foreach ($arItems2 as $item2)
                {
                    if ($item==$item2)
                        unset($result[$key][$index]);
                }
            }
            
        }
    }   */
    $arTypes=array('p-p'=>". От пункта приема до пункта выдачи/почтомата.", 
        'p-d'=>". От пункта приема до двери.",
        'd-p'=>". От двери до пункта выдачи/почтомата.",
        'd-d'=>". От двери до двери.");
    $arResult=array();
    foreach($result as $key => $arItems)
    {
        foreach($arItems as $index => $item)
        {
            $arItems[$index]->serviceName.=$arTypes[$key];
            $arItems[$index]->days.=' дн.';
        }
        $arResult=array_merge($arResult, $arItems);
    }
    
     
    foreach($arResult as $index => $item)
    {
      //  printr($item);
        if ($item->serviceCode!='PCL')
            unset($arResult[$index]);
    }   
	
    //printr($arResult);
		foreach ($arResult as $v){
				echo json_encode(array('price' => round($v->cost), 'time' => $v->days, 'condition' =>$v->serviceName)).PHP_EOL;
			}
	}
    
    
    function printr($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
    function vardump($arr)
    {
        echo '<pre>';
        var_dump($arr);
        echo '</pre>';
    }
?>