<?php 

    require_once("scripts/database.php");
    $db = new MySql("localhost", "ps", "psmysql01", "agregator");
    $db->connect();
	$page_size = 10;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
	$total_pages = $db->fetch_field('SELECT COUNT(*) FROM `news`');
	$total_pages = intval($total_pages / $page_size) + ($total_pages % $page_size != 0);
	if ($page > $total_pages || $page < 1) {
		$page = 1;
	}
    $start = ($page - 1) * $page_size;
	$all_news = $db->fetch_all("SELECT `id`, `title`, DATE(`post_time`) as date, `tags`, SUBSTRING(`content`, 1, (INSTR(`content`, '[cut]')-1)) as `content` 

                                FROM `news`
                                order by `post_time` desc
                                limit $start, $page_size");
    require('_index-template.php');
?>
