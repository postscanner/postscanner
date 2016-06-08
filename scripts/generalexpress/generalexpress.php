<?php
function getDim($volume) {
    return pow($volume, 1.0/3) * 100;
}

try {

list($originalCity) = split(',', $argv[1]);
list($deliviryCity) = split(',', $argv[2]);
$weight = str_replace(',', '.', $argv[3]);
$weight = max($weight - 0.001, 0);

$volume = $argv[4];
$t = new Build();
$r = $t->DataBase('connect', NULL);

if ($originalCity == 'Москва' && $deliviryCity == 'Москва' || $originalCity == 'Санкт-Петербург' && $deliviryCity == 'Санкт-Петербург') {
	$city = ($originalCity == 'Москва') ? 'Moscow' : 'SaintPetersburg';

	

	
	$r = $t->DataBase('calculate:order-car-delivery', 
							array('order-goods-qte'=>'1',
									'order-goods-weight'=>$weight,
									'order-type-goods'=>'goods',
									'order-type'=>'order-car-delivery',
									'order-goods-size-height'=>getDim($volume),
									'order-goods-size-length'=>getDim($volume),
									'order-goods-size-width'=>getDim($volume),
									'order-city'=>$city,
									'order-address-fence'=>'in',
									'order-address-delivery'=>'in',
									'order-loadunload'=>'no',
									'order-time'=>'24'));
	echo json_encode($r). PHP_EOL;

	$r = $t->DataBase('calculate:order-urgent', 
							array('order-goods-qte'=>'1',
									'order-goods-weight'=>$weight,
									'order-type-goods'=>'goods',
									'order-type'=>'order-urgent',
									'order-goods-size-height'=>getDim($volume),
									'order-goods-size-length'=>getDim($volume),
									'order-goods-size-width'=>getDim($volume),
									'order-city'=>$city,
									'order-address-fence'=>'in',
									'order-address-delivery'=>'in',
									'order-time'=>'2'));
	echo json_encode($r). PHP_EOL;

		
	$r = $t->DataBase('calculate:order-urgent', 
							array('order-goods-qte'=>'1',
									'order-goods-weight'=>$weight,
									'order-type-goods'=>'goods',
									'order-type'=>'order-urgent',
									'order-goods-size-height'=>getDim($volume),
									'order-goods-size-length'=>getDim($volume),
									'order-goods-size-width'=>getDim($volume),
									'order-city'=>$city,
									'order-address-fence'=>'in',
									'order-address-delivery'=>'in',
									'order-time'=>'4'));
	echo json_encode($r). PHP_EOL;
	
	$r = $t->DataBase('calculate:order-urgent', 
							array('order-goods-qte'=>'1',
									'order-goods-weight'=>$weight,
									'order-type-goods'=>'goods',
									'order-type'=>'order-urgent',
									'order-goods-size-height'=>getDim($volume),
									'order-goods-size-length'=>getDim($volume),
									'order-goods-size-width'=>getDim($volume),
									'order-city'=>$city,
									'order-address-fence'=>'in',
									'order-address-delivery'=>'in',
									'order-time'=>'24'));
	echo json_encode($r). PHP_EOL;
} else {
	$r = $t->DataBase('calculate:order-intercity', 
							array('order-goods-qte'=>'1',
									'order-goods-weight'=>$weight,
									'order-type-goods'=>'goods',
									'order-type'=>'order-intercity',
									'order-goods-size-height'=>getDim($volume),
									'order-goods-size-length'=>getDim($volume),
									'order-goods-size-width'=>getDim($volume),
									'order-city1'=>$originalCity,
									'order-city2'=>$deliviryCity));
	echo json_encode($r). PHP_EOL;
}
}
catch (SoapFault $fault) {
	$error = 1;
	alert("=(");
	}

								



class Build {
	public $sql_link;
	public $sql_query;

	function RunSQL($sql) {
		$this->sql_query=mysql_query($sql) or die(mysql_error());		
	}

	function DataBase($type,$const) {
		switch($type) {
			case 'connect':
				$this->sql_link = mysql_connect('bora.beget.ru', 'shonik_calc', '4kXgr4Bx');
				mysql_query("SET character_set_results = 'utf8', character_set_client = 'utf8', character_set_connection = 'utf8', character_set_database = 'utf8', character_set_server = 'utf8'", $this->sql_link);				
				break;
			case 'close': 
				mysql_close();				
			break;			
			case 'calculate:order-intercity':
				$query_city1="	SELECT city.id, city.name, city.zone, city.time FROM `shonik_calc`.city as city
								WHERE city.name='".$const['order-city1']."'";
				$query_city2="	SELECT city.id, city.name, city.zone, city.time FROM `shonik_calc`.city as city
								WHERE city.name='".$const['order-city2']."'";
				$city1 = mysql_query($query_city1);
				$city2 = mysql_query($query_city2);

				$arr_city1 = @mysql_fetch_array($city1);
				$city_zone1='';
				$city_zone1=@$arr_city1['zone'];
				$time1='';
				$time1=@$arr_city1['time'];

				$arr_city2 = @mysql_fetch_array($city2);
				$city_zone2='';
				$city_zone2=@$arr_city2['zone'];
				$time2='';
				$time2=@$arr_city2['time'];

				/* Weight Value Check */
				if(@$const['order-goods-size-width']!=''&&@$const['order-goods-size-length']!=''&&@$const['order-goods-size-height']!='') {
					$weight2=($const['order-goods-size-width']*$const['order-goods-size-length']*$const['order-goods-size-height'])/6000;
					if($weight2!=0) {
						if($const['order-goods-weight']<$weight2) {
							$const['order-goods-weight']=$weight2;
						}
					}
				}
				/* Weight Value Check */

				$const['order-goods-weight']=$const['order-goods-weight']*1000;

				if($city_zone1!=''&&$city_zone2!='') {
					// ?!?! $const['order-goods-weight']=$const['order-goods-weight']*1000;
					if($const['order-goods-weight']<='300') {
						$weight='300';
					}
					else if($const['order-goods-weight']>'300'&&$const['order-goods-weight']<='1000') {
						$weight='1000';
					}
					else if($const['order-goods-weight']>'1000') {
						$weight='UP';
					}

					$query_zone1="	SELECT zone.zone, zone.weight, zone.price 
									FROM `shonik_calc`.zone as zone 
									WHERE 	zone.zone='".$city_zone1."' AND
											zone.weight='".$weight."'";
					$query_zone2="	SELECT zone.zone, zone.weight, zone.price 
									FROM `shonik_calc`.zone as zone 
									WHERE 	zone.zone='".$city_zone2."' AND
											zone.weight='".$weight."'";

					$zone1 = mysql_query($query_zone1);
					$zone2 = mysql_query($query_zone2);

					$arr_zone1 = @mysql_fetch_array($zone1);
					$city_price1=0;
					$city_price1=@$arr_zone1['price'];

					$arr_zone2 = @mysql_fetch_array($zone2);
					$city_price2=0;
					$city_price2=@$arr_zone2['price'];

					/* Дополнительный вес */
					if($weight=='UP') {

						$weight='1000';

						$price_zone1="	SELECT zone.zone, zone.weight, zone.price 
						FROM `shonik_calc`.zone as zone 
						WHERE zone.zone='".$city_zone1."' AND zone.weight='".$weight."'";
		
						$price_zone2="	SELECT zone.zone, zone.weight, zone.price 
										FROM `shonik_calc`.zone as zone 
										WHERE zone.zone='".$city_zone2."' AND zone.weight='".$weight."'";

						$price1 = mysql_query($price_zone1);
						$price2 = mysql_query($price_zone2);

						$arr_price1 = @mysql_fetch_array($price1);
						$city_price_up1='';
						$city_price_up1=@$arr_price1['price'];

						$arr_price2 = @mysql_fetch_array($price2);
						$city_price_up2='';
						$city_price_up2=@$arr_price2['price'];


						$order_goods_weight=$const['order-goods-weight']/1000;
						if($order_goods_weight>0&&$order_goods_weight<1) {
							$price_result1=$city_price_up1;
							$price_result2=$city_price_up2;
						} 
						else if($order_goods_weight>=1) {
							$price1=$city_price1*ceil($order_goods_weight);
							$price_result1=$city_price_up1+$price1;
							$price2=$city_price2*ceil($order_goods_weight);
							$price_result2=$city_price_up2+$price2;							
						}					
						else {
							$price_result1=$city_price_up1;
							$price_result2=$city_price_up2;
						}

					}
					else { 
						$price_result1=$city_price1;
						$price_result2=$city_price2;
					}

					if($city_zone1==$city_zone2) {
						$output= array('price' => $price_result1, 'time' => $time1, 'condition' => 'Тариф МЕЖГОРОД');
					}
					else if($city_zone1!=$city_zone2) {
						if($city_zone1==0) $output=$price_result2;
						else $output=$price_result1*1.2;

						$output= array('price' => $output, 'time' => $time2, 'condition' => 'Тариф МЕЖГОРОД');				
					}
					//$output='TEST'.$city_price1.'+'.$city_price2.'='.@$price1.'='.@$price2.' '.@$order_goods_weight;
				}
				else {
                    $output= array('condition' => 'Цену и сроки доставки уточняйте у операторов по телефону.');
                    $output= '';
				}

//				$output='test'.'city1='.@$city1.'city2='.@$city2;
//				$output=$output.'<br/>'.$const['order-city1'].$const['order-city2'].'city1='.@$city_zone1.'city2='.@$city_zone2;
				return $output;
			break;
			
			case 'calculate:order-urgent':
				$price2=0;
				$error='';

				if(@$const['order-address-fence']=='in'&&@$const['order-address-delivery']=='in') {
					$const['area']='in';
				}
				else {
					$const['area']='out';
				}

				/* Weight Value Check */
				if(@$const['order-goods-size-width']!=''&&@$const['order-goods-size-length']!=''&&@$const['order-goods-size-height']!='') {
					$weight2=($const['order-goods-size-width']*$const['order-goods-size-length']*$const['order-goods-size-height'])/6000;
					if($weight2!=0) {
						if($const['order-goods-weight']<$weight2) {
							$const['order-goods-weight']=$weight2;
						}
					}
					else if($const['order-goods-weight']==0) $error='Стоимость доставки уточняйте у наших операторов.';
				}
				/* Weight Value Check */

				$const['order-goods-weight']=$const['order-goods-weight']*1000;
				
				
				if($const['order-goods-weight']>6000) $error='Недопустимый вес груза, воспользуйтесь автодоставкой!';

				if($const['order-goods-weight']==0&&@$const['order-goods-size-width']==''&&@$const['order-goods-size-length']==''&&@$const['order-goods-size-height']=='') $error='Стоимость доставки уточняйте у наших операторов';

				if(@$const['order-time']<=6) {
					if(@$const['order-type-goods']=='documents'&&@$const['order-goods-weight']<300) {
						$const['type-goods']='Documents';
						$const['qte']='-';
						$const['weight']='300';
					}
					else if((@$const['order-type-goods']=='documents'||@$const['order-type-goods']=='goods')&&@$const['order-goods-weight']>=300&&@$const['order-goods-weight']<1000) {
						$const['type-goods']='Goods';
						$const['qte']='-';
						$const['weight']='300-1000';
					}
					else if((@$const['order-type-goods']=='documents'||@$const['order-type-goods']=='goods')&&@$const['order-goods-weight']>=1000&&@$const['order-goods-weight']<=1500) {
						$const['type-goods']='GoodsBig';
						$const['qte']='-';
						$const['weight']='300-1500';
					}
					else if(@$const['order-type-goods']=='goods'&&@$const['order-goods-weight']<300) {
						$const['type-goods']='Goods';
						$const['qte']='-';
						$const['weight']='300-1000';
					}
					else if((@$const['order-type-goods']=='documents'||@$const['order-type-goods']=='goods')&&@$const['order-goods-weight']>=1500) {
						$const['type-goods']='UP';
						$const['qte']='-';
						$const['weight']='300';

						$query="	SELECT tariffs.price FROM `shonik_calc`.tariffs tariffs 
										WHERE tariffs.order='order-urgent' AND
										tariffs.city='".$const['order-city']."' AND
										tariffs.area='".$const['area']."' AND
										tariffs.time='".$const['order-time']."' AND	
										tariffs.type='".$const['type-goods']."' AND
										tariffs.qte='".$const['qte']."' AND
										tariffs.weight='".$const['weight']."'";
						$result = mysql_query($query);
						//exit;
						$temp = mysql_fetch_array($result);
						$temp=$temp['price'];
														

						$const['type-goods']='GoodsBig';
						$const['qte']='-';
						$const['weight']='300-1500';

						/* Добавочный вес */
						$temp2=$const['order-goods-weight']/300-3;					
						if($temp2>0&&$temp2<1) {
							$price2=$temp;
						} 
						else if($temp2>1) {
							$price2=$temp*ceil($temp2);
						}					
						else $price2=0;
					}
				}

				/* Order Time >=6 */
				if(@$const['order-time']==24) {

					if(@$const['order-goods-qte']>=1&&@$const['order-goods-qte']<=10&&@$const['order-time']==24) {
						$const['qte']='1-10';
					}
					else if(@$const['order-goods-qte']>=11&&@$const['order-goods-qte']<=30&&@$const['order-time']==24) {
						$const['qte']='11-30';
					}
					else if(@$const['order-goods-qte']>30&&@$const['order-time']==24) {
						$error='Кол-во превышает 30 шт., воспользуйтесь рассылкой.';
					}
					else {
						$error='Неправильное кол-во шт.';						
						//$const['qte']='-';
					}
					
					if(@$const['order-type-goods']=='documents'&&@$const['order-goods-weight']<300) {
						$const['type-goods']='Documents';
						$const['weight']='300';
					}
					else if((@$const['order-type-goods']=='documents'||@$const['order-type-goods']=='goods')&&@$const['order-goods-weight']>=300&&@$const['order-goods-weight']<1000) {
						$const['type-goods']='Goods';
						$const['weight']='300-1000';
					}
					else if((@$const['order-type-goods']=='documents'||@$const['order-type-goods']=='goods')&&@$const['order-goods-weight']>=1000&&@$const['order-goods-weight']<=1500) {
						$const['type-goods']='GoodsBig';
						$const['weight']='300-1500';
					}
					else if(@$const['order-type-goods']=='goods'&&@$const['order-goods-weight']<300) {
						$const['type-goods']='Goods';
						$const['weight']='300-1000';
					}
					else if((@$const['order-type-goods']=='documents'||@$const['order-type-goods']=='goods')&&@$const['order-goods-weight']>=1500) {
						$const['type-goods']='UP';
						$const['weight']='300';

						$query="	SELECT tariffs.price FROM `shonik_calc`.tariffs tariffs 
										WHERE tariffs.order='order-urgent' AND
										tariffs.city='".$const['order-city']."' AND
										tariffs.area='".$const['area']."' AND
										tariffs.time='".$const['order-time']."' AND	
										tariffs.type='".$const['type-goods']."' AND
										tariffs.qte='".$const['qte']."' AND
										tariffs.weight='".$const['weight']."'";
						$result = mysql_query($query);
						//exit;
						$temp = mysql_fetch_array($result);
						$temp=$temp['price'];
						
						
						
						$const['type-goods']='GoodsBig';
						//$const['qte']='-';
						$const['weight']='300-1500';

						/* Добавочный вес */
						$temp2=$const['order-goods-weight']/300-3;
						if($temp2>0&&$temp2<1) {
							$price2=$temp;
						} 
						else if($temp2>1) {
							$price2=$temp*ceil($temp2);
						}					
						else $price2=0;						
					}
				}
					
				else if(@$const['order-time']==48) {

					if(@$const['order-goods-qte']>=1&&@$const['order-goods-qte']<=10&&@$const['order-time']==48) {
						$const['qte']='-';
					}
					else if(@$const['order-goods-qte']>=11&&@$const['order-goods-qte']<=30&&@$const['order-time']==48) {
						$const['qte']='-';
					}
					else if(@$const['order-goods-qte']>30&&@$const['order-time']==48) {
						$error='Кол-во превышает 30 шт., воспользуйтесь рассылкой.';
					}
					else {
						$error='Неправильное кол-во шт.';						
						//$const['qte']='-';
					}
					
					if(@$const['order-type-goods']=='documents'&&@$const['order-goods-weight']<300) {
						$const['type-goods']='Documents';
						$const['weight']='300';
					}
					else if((@$const['order-type-goods']=='documents'||@$const['order-type-goods']=='goods')&&@$const['order-goods-weight']>=300&&@$const['order-goods-weight']<1000) {
						$const['type-goods']='Goods';
						$const['weight']='300-1000';
					}
					else if((@$const['order-type-goods']=='documents'||@$const['order-type-goods']=='goods')&&@$const['order-goods-weight']>=1000&&@$const['order-goods-weight']<=1500) {
						$const['type-goods']='GoodsBig';
						$const['weight']='300-1500';
					}
					else if(@$const['order-type-goods']=='goods'&&@$const['order-goods-weight']<300) {
						$const['type-goods']='Goods';
						$const['weight']='300-1000';
					}
					else if((@$const['order-type-goods']=='documents'||@$const['order-type-goods']=='goods')&&@$const['order-goods-weight']>=1500) {
						$const['type-goods']='UP';
						$const['weight']='300';
						$const['qte']='-';

						$query="	SELECT tariffs.price FROM `shonik_calc`.tariffs tariffs 
										WHERE tariffs.order='order-urgent' AND
										tariffs.city='".$const['order-city']."' AND
										tariffs.area='".$const['area']."' AND
										tariffs.time='".$const['order-time']."' AND	
										tariffs.type='".$const['type-goods']."' AND
										tariffs.qte='".$const['qte']."' AND
										tariffs.weight='".$const['weight']."'";
						$result = mysql_query($query);
						//exit;
						$temp = mysql_fetch_array($result);
						$temp=$temp['price'];

						$const['type-goods']='GoodsBig';
						//$const['qte']='-';
						$const['weight']='300-1500';

						/* Добавочный вес */
						$temp2=$const['order-goods-weight']/300-3;
						if($temp2>0&&$temp2<1) {
							$price2=$temp;
						} 
						else if($temp2>1) {
							$price2=$temp*ceil($temp2);
						}					
						else $price2=0;
					}
				}
				/* Order Time >=6 */

				if($error!='') {
					$output=$error;
					return '';
				} else {
					$query="	SELECT tariffs.price FROM `shonik_calc`.tariffs tariffs 
									WHERE tariffs.order='order-urgent' AND
									tariffs.city='".$const['order-city']."' AND
									tariffs.area='".$const['area']."' AND
									tariffs.time='".$const['order-time']."' AND	
									tariffs.type='".$const['type-goods']."' AND
									tariffs.qte='".$const['qte']."' AND
									tariffs.weight='".$const['weight']."'";
					$result = mysql_query($query);
					//exit;
					$output = mysql_fetch_array($result);

					$output=$output['price']+$price2;
					
					//if($const['area']=='out') $output=$output*2;
					

					if($const['order-address-fence']=='out'&&$const['order-time']=='6') {
					return '';
					}
					
					if($const['order-address-delivery']=='out'&&$const['order-time']=='6') {
					return '';
					}
					if($const['order-address-fence']=='out'&&$const['order-time']=='4') {
					return '';
					}
					
					if($const['order-address-delivery']=='out'&&$const['order-time']=='4') {
					return '';
					}

					if($const['order-address-fence']=='out'&&$const['order-address-delivery']=='out') {
					return '';
					}
				}
				$output = (string) $output;
				$output = array('price' => $output, 'time' => 'В течение '.$const['order-time'].' часов', 'condition' => 'Тариф СРОЧНАЯ ДОСТАВКА');

				return $output;
			break;				
			case 'calculate:order-car-delivery':
				$output='';
				$type='Documents';
				
				/* Weight Value Check */
				if(@$const['order-goods-size-width']!=''&&@$const['order-goods-size-length']!=''&&@$const['order-goods-size-height']!='') {
					$weight2=($const['order-goods-size-width']*$const['order-goods-size-length']*$const['order-goods-size-height'])/6000;
					if($weight2!=0) {
						if($const['order-goods-weight']<$weight2) {
							$const['order-goods-weight']=$weight2;
						}
					}
				}
				/* Weight Value Check */

//				$const['order-goods-weight']=$const['order-goods-weight']*1000;

				if($const['order-goods-weight']<='100') {
					$weight='100';
				}
				else if($const['order-goods-weight']>='100') {
					$weight='50';
					$type='UP';
				}
				else $weight=$const['order-goods-weight'];

				if($const['order-address-fence']=='in'&&$const['order-address-delivery']=='in') {
					$area='in';
					$area_price='in';
				}
				else if($const['order-address-fence']=='out'&&$const['order-address-delivery']=='in'||$const['order-address-fence']=='in'&&$const['order-address-delivery']=='out') {
					$area='out';	
					$area_price='in';					
				}
				else {
					$area='out';
					$area_price='out';
				}

				$query_car1="	SELECT tariffs.price
								FROM `shonik_calc`.tariffs as tariffs 
								WHERE tariffs.order='order-car-delivery' AND
								tariffs.city='".$const['order-city']."' AND
								tariffs.area='".$area."' AND
								tariffs.time='".$const['order-time']."' AND
								tariffs.type='".$type."' AND
								tariffs.weight='".$weight."'";

				$car1 = mysql_query($query_car1);

				$arr_car1 = @mysql_fetch_array($car1);
				$car_price1='';
				$car_price1=@$arr_car1['price'];

				if($type=='UP') {

					$weight='100';

					$price_car1="	SELECT tariffs.price
									FROM `shonik_calc`.tariffs as tariffs 
									WHERE tariffs.order='order-car-delivery' AND
									tariffs.city='".$const['order-city']."' AND
									tariffs.area='".$area."' AND
									tariffs.time='".$const['order-time']."' AND
									tariffs.type='Documents' AND
									tariffs.weight='".$weight."'";
	
					$price1 = mysql_query($price_car1);

					$arr_price1 = @mysql_fetch_array($price1);
					$car_price_up1='';
					$car_price_up1=@$arr_price1['price'];

					$order_goods_weight=$const['order-goods-weight']/50-2;
					if($order_goods_weight>0&&$order_goods_weight<1) {
						$price_result1=$car_price_up1;
					} 
					else if($order_goods_weight>=1) {
						$price1=$car_price1*ceil($order_goods_weight);
						$price_result1=$car_price_up1+$price1;
					}					
//					else {
//						$price_result1=$car_price_up1;
//					}

					$output=$price_result1;
				}
				else $output=$car_price1;

				if($const['order-loadunload']=='yes') {
					$output=$output+300;
				}
				if($area_price=='out') {
					$output=$output*2;
				}

				
				$output= array('price' => $output, 'time' => 'В течение 1 дня', 'condition' => 'Тариф АВТОДОСТАВКА');
				return $output;
			break;			
			
			case 'search_city':
				$html = '';
				$html .= '<li class="result'.$const['block'].'">';
				//$html .= '<a target="_blank" href="urlString">';
				$html .= 'nameString';
				//$html .= '</a>';
				$html .= '</li>';

				// Get Search
				//$search_string = preg_replace("/\$.*?/", " ", $_GET['query']);
				//$_GET['city']=utf8_encode($_GET['city']);
				$search_string = $_GET['city'];
				$search_string = mysql_real_escape_string($search_string);

				// Check Length More Than One Character
				if (strlen($search_string) >= 1 && $search_string !== ' ') {
					// Build Query
					$query = 'SELECT city.id, city.name FROM `shonik_calc`.city as city WHERE city.name LIKE "%'.$search_string.'%"';				

					// Do Search
					$result = mysql_query($query);
					//exit;
					while($results = mysql_fetch_array($result)) {
						$result_array[] = $results;
					}
				//exit;
					// Check If We Have Results
					if (isset($result_array)) {
						foreach ($result_array as $result) {

							// Format Output Strings And Hightlight Matches
							//
							$display_name = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['name']);
							$display_url = urlencode($result['name']);

							// Insert Name
							$output = str_replace('nameString', $display_name, $html);

							// Insert URL
							$output = str_replace('urlString', $display_url, $output);

							// Output
							return $output;
						}
					}else{

						// Format No Results Output
						$output = str_replace('urlString', 'javascript:void(0);', $html);
						$output = str_replace('nameString', 'Города нет в списке.Стоимость доставки уточняйте у операторов.', $output);
						$output = str_replace('funcStr', 'Sorry :(', $output);

						// Output
						return $output;
					}
				}
			break;
		}
	}		

	function SearchCity($const) {
		$calculator='';
		$this->DataBase('connect','');
		$calculator.=$this->DataBase('search_city',$const);
		$this->DataBase('close','');
		return array('calculator'=>$calculator);
	}
	
	function View($const) {
		$calculator='';
		$calculator.='<h2>Тип доставки</h2>';		
		$calculator.='<input type="radio" class="tab-calc" id="order-urgent" name="order" value="order-urgent"/><label for="order-urgent">Срочный заказ</label>';
		$calculator.='<input type="radio" class="tab-calc" id="order-delivery" name="order" value="order-delivery" /><label for="order-delivery">Рассылка</label>';
		$calculator.='<input type="radio" class="tab-calc" id="order-rent" name="order" value="order-rent" /><label for="order-rent">Аренда</label>';
		$calculator.='<input type="radio" class="tab-calc" id="order-car-delivery" name="order" value="order-car-delivery" /><label for="order-car-delivery">Автодоставка</label>';
		$calculator.='<input type="radio" class="tab-calc" id="order-intercity" name="order" value="order-intercity" /><label for="order-intercity">Межгород</label>';
		return array('calculator'=>$calculator);
	}
	function Settings($const) {
		$calculator='';
		switch ($const['order']) {
			case 'order-intercity':
				$calculator.='<script type="text/javascript" src="./scripts/search_city.js"></script>';
				$calculator.='<h2>Отправитель</h2>';
				$calculator.='<input type="text" id="search1" class="tab-calc-settings3" autocomplete="off">';
				$calculator.='<ul id="results1"></ul>';

				$calculator.='<h2>Получатель</h2>';
				$calculator.='<input type="text" id="search2" class="tab-calc-settings3" autocomplete="off">';
				$calculator.='<ul id="results2"></ul>';
				$calculator.='<input type="hidden" class="tab-calc-settings3 order-intercity-type" name="order-type" value="'.$const['order'].'"/>';
			break;	
			default:
				break;
		}
		return array('calculator'=>$calculator);
	}
	function Settings2($const) {
		$calculator='';
		switch ($const['order-type']) {
			default:
				break;
		}
		return array('calculator'=>$calculator);
	}

	function Settings3($const) {
		$calculator='';
		switch($const['order-type']) {
			default:

			break;
		}
		return array('calculator'=>$calculator);
	}

	function Settings4($const) {
		$calculator='';

		switch($const['order-type']) {
			case 'order-intercity':
				$calculator.='<h2>Тип отправления</h2>';
				$calculator.='<input type="radio" class="tab-calc-settings4 order-intercity-type-goods" id="order-intercity-type-goods-documents" name="order-type-goods" value="documents"/><label for="order-intercity-type-goods-documents">Документы</label>';
				$calculator.='<input type="radio" class="tab-calc-settings4 order-intercity-type-goods" id="order-intercity-type-goods-goods" name="order-type-goods" value="goods" /><label for="order-intercity-type-goods-goods">Груз</label>';
				$calculator.='<input type="hidden" class="tab-calc-settings4 order-intercity-type" name="order-type" value="'.$const['order-type'].'"/>';
				$calculator.='<input type="hidden" class="tab-calc-settings4 order-intercity-city1" name="order-city1" value="'.$const['city1'].'"/>';
				$calculator.='<input type="hidden" class="tab-calc-settings4 order-intercity-city2" name="order-city2" value="'.$const['city2'].'"/>';
			break;
			default:
				$calculator='';
			break;
		}

		return array('calculator'=>$calculator);
	}

	function Settings5($const) {
		$calculator='';

		switch($const['order-type']) {
			case 'order-intercity':
				$calculator.='<h2>Вес (кг)</h2>';
				$calculator.='<div id="block_weight">';
				$calculator.='<input type="text" class="tab-calc-settings5 goods-weight" id="order-intercity-goods-weight" name="order-goods-weight" value="0.25" maxlength="14"/>';
				$calculator.='<input type="button" class="tab-calc-settings5 weight-minus" id="order-intercity-goods-weight-minus" name="order-goods-weight-minus" value=""/>';
				$calculator.='<input type="button" class="tab-calc-settings5 weight-plus" id="order-intercity-goods-weight-plus" name="order-goods-weight-plus" value=""/>';
				$calculator.='</div>';
				if($const['order-type-goods']=='goods') {
					$calculator.='<h2>Ш x Д x В (см)</h2>';
					$calculator.='<div id="block_size">';
					$calculator.='<input type="text" class="tab-calc-settings5 goods-size-width" id="order-intercity-goods-size-width" name="order-goods-size-width" value="0" maxlength="4"/>';
					$calculator.='<input type="button" class="tab-calc-settings5 size-width-minus" id="order-intercity-goods-size-width-minus" name="order-goods-size-width-minus" value=""/>';
					$calculator.='<input type="button" class="tab-calc-settings5 size-width-plus" id="order-intercity-goods-size-width-plus" name="order-goods-size-width-plus" value=""/>';
					
					$calculator.='<div id="multiply01" class="multiply">x</div>';

					$calculator.='<input type="text" class="tab-calc-settings5 goods-size-length" id="order-intercity-goods-size-length" name="order-goods-size-length" value="0" maxlength="4"/>';
					$calculator.='<input type="button" class="tab-calc-settings5 size-length-minus" id="order-intercity-goods-size-length-minus" name="order-goods-size-length-minus" value=""/>';
					$calculator.='<input type="button" class="tab-calc-settings5 size-length-plus" id="order-intercity-goods-size-length-plus" name="order-goods-size-length-plus" value=""/>';

					$calculator.='<div id="multiply02" class="multiply">x</div>';

					$calculator.='<input type="text" class="tab-calc-settings5 goods-size-height" id="order-intercity-goods-size-height" name="order-goods-size-height" value="0" maxlength="4"/>';
					$calculator.='<input type="button" class="tab-calc-settings5 size-height-minus" id="order-intercity-goods-size-height-minus" name="order-goods-size-height-minus" value=""/>';
					$calculator.='<input type="button" class="tab-calc-settings5 size-height-plus" id="order-intercity-goods-size-height-plus" name="order-goods-size-height-plus" value=""/>';					

					$calculator.='</div>';
				}

				$calculator.='<input type="hidden" class="tab-calc-settings5 order-intercity-type-goods" id="order-intercity-type-goods" name="order-type-goods" value="'.$const['order-type-goods'].'"/>';
				$calculator.='<input type="hidden" class="tab-calc-settings5 order-intercity-type" name="order-type" value="'.$const['order-type'].'"/>';
				$calculator.='<input type="hidden" class="tab-calc-settings5 order-intercity-city1" name="order-city1" value="'.$const['order-city1'].'"/>';
				$calculator.='<input type="hidden" class="tab-calc-settings5 order-intercity-city2" name="order-city2" value="'.$const['order-city2'].'"/>';
			break;
			default:
				$calculator='';
			break;
		}
		$calculator.='<input type="button" class="tab-calc-settings5 result" id="result" name="result" value="Рассчитать"/>';
		return array('calculator'=>$calculator);
	}

	function Settings6($const) {
		$calculator='';

		switch($const['order-type']) {
			case 'order-intercity':
				$calculator.='<h2>Стоимость</h2>';
				$this->DataBase('connect', '');
				$calculator.='<p class="price">'.$this->DataBase('calculate:order-intercity', $const).'<p>';				
				$this->DataBase('close', '');				
			break;
			default:
			$calculator='';
			break;
		}
		return array('calculator'=>$calculator);
	}
}
?>