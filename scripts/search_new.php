<?php
    
    error_reporting(E_ALL);
    function printr($arr)
    {
        echo '<pre>';
        print_r($arr);
        echo '</pre>';
    }
   // die('test');
    // ini_set('display_errors', 'on');
    require("database.php");
    $db = new MySql("localhost", "ps", "psmysql01", "agregator");
    $db->connect();
    function get_name($ag) {
        return $ag->calc_url ? '<a target="_blank" href='.$ag->calc_url.'>'.$ag->name.'</a>' : $ag->name;
    }
    
    function get_logo($ag) {
        // return $_SERVER['DOCUMENT_ROOT'].'/img/logo/'.$name.'.png';
        if (file_exists($_SERVER['DOCUMENT_ROOT'].'/img/logo/'.$ag->name.'.png')) {
            return './img/logo/'.$ag->name.'.png';
        }
        return "./assets/frontend/pages/img/brands/canon.jpg";
    }
    
    function get_agregator($id) {
        global $db;
        $db->query("SELECT * from agregators where id=".$id);
        return $db->fetch_object();
    }
    
    $locale = 'ru_RU.UTF-8';
    putenv('LANG='.$locale);
    setlocale(LC_ALL, $locale);
	$fromCity = $_REQUEST["from"];
	$toCity = $_REQUEST["to"];
	$weight = $_REQUEST["weight"];
    $volume = $_REQUEST["volume"];
    $value = $_REQUEST["value"];
    $fromCity = "Москва";
    $toCity = "Махачкала";
    $weight = "1";
    $volume = "1";
    $value = "1";
    printr($fromCity);
	//THIS IS BAD, NEED TO REWRITE IT LATER
//	$command = "echo -e \"".$fromCity."\n".$toCity."\n".$weight."\n\"";

//	$output1 = shell_exec($command." | php dpd.php");
//	$output2 = shell_exec($command." | python3 emspost.py 2> log");
//	$output3 = shell_exec($command." | python3 ponyexpress.py");
//    print_r($output2);
//    die();
	///////////////////////////////////////
    // echo exec('locale charmap');
    // echo setlocale(LC_ALL, 0), PHP_EOL;
    // echo exec('locale charmap');
	$output = shell_exec("python3 get_all_new.py \"".$fromCity."\" \"".$toCity."\" \"".$weight."\" \"".$volume."\" \"".$value."\" 2>> ".$_SERVER['DOCUMENT_ROOT']."/logs/log");
//	$output = system("python3 get_all.py ".$fromCity." ".$toCity." ".$weight." 2>> log");
    // print_r("python3 get_all.py \"".$fromCity."\" \"".$toCity."\" \"".$weight."\" \"".$volume."\" \"".$value."\" 2>> log".PHP_EOL);
    //print_r($output);
    // exit();
    $sites = json_decode($output);
    if (count($sites) == 0) {
        print_r('<h2 class="animated">Предложений не найдено</h2>');
        die();
    }
    function cmp($a_j, $b_j) {
        $a = json_decode($a_j, true);
        $b = json_decode($b_j, true);
        if ($a['low_price'] == $b['low_price'])
            return 0;
        return ($a['low_price'] < $b['low_price']) ? -1 : 1;
    }
    usort($sites, "cmp");
?>
<div class='portlet box blue-madison'>
    <div class='portlet-title'>
								<div class="caption">
									<i class="fa fa-envelope"></i>Отправление <?php echo $fromCity ?> - <?php echo $toCity ?>     Вес <?php echo $weight ?> кг
								</div>
								
							</div>
							<div class="portlet-body">
								<table class="table table-striped table-bordered table-hover" id="sample_3">
								<thead>
								<tr>
									<th>
									</th>
									<th>
										 Компания
									</th>
									<th>
										 Срок<span class="hidden-xs"> доставки</span>
									</th>
									<th>
										 Стоимость
									</th>	
									<th>
										 Условия доставки
									</th>						
								</tr>
								</thead>
								<tbody>

<?php
    $agregators = [];
    for ($i = 0; $i < count($sites); $i++) {
        $cur = json_decode($sites[$i], true);
        for ($j = 0; $j < count($cur['prices']); $j++) {
            $site = $agregators[$i] = get_agregator($cur['site_id']);
            print_r('<tr>');
            
            print_r('<td>');        
            if (strlen($site->calc_url) > 0) {
                print_r('<a target="_blank" href="'.$site->calc_url.'">');
            }
            print_r('<img class="img-responsive" height="10" width="30" src="'.get_logo($site).'" alt="" 
                                            style="
                                                        width: 70px;
                                                        height: 30px;
                                                        "
                                            >
                                            </img>
    ');
            if (strlen($site->calc_url) > 0) {
                print_r('</a>');
            }
            print_r('</td>');
            
            print_r('<td>');
            print_r(get_name($site));
            print_r('</td>');
            print_r('<td>'.(strlen($cur['times'][$j]) > 0 ? $cur['times'][$j] : "Уточните у перевозчика").'');
            print_r('</td>');
            print_r("<td>".floor($cur['prices'][$j])." рублей</td>");
            print_r("<td>".(strlen($cur['conditions'][$j]) > 0 ? $cur['conditions'][$j] : "Стандарт")."</td>");
            print_r("</tr>");
        }
    }
?>
                                </tbody>
                            </div>
</div>
<select class="selectpicker hidden" data-style="company-list-button"  data-selected-text-format="none" id="compainsList" multiple="multiple">
    <option selected="selected">Все</option>
    <?php
        for ($i = 0; $i < count($sites); ++$i) {
            print_r('<option selected="selected" value="'.$agregators[$i]->name.'">'.$agregators[$i]->name.'</option>
            ');
        }
    ?>
</select>