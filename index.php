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

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
(function (d, w, c) {
    (w[c] = w[c] || []).push(function() {
        try {
            w.yaCounter27119789 = new Ya.Metrika({id:27119789,
                    webvisor:true,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true});
        } catch(e) { }
    });

    var n = d.getElementsByTagName("script")[0],
        s = d.createElement("script"),
        f = function () { n.parentNode.insertBefore(s, n); };
    s.type = "text/javascript";
    s.async = true;
    s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

    if (w.opera == "[object Opera]") {
        d.addEventListener("DOMContentLoaded", f, false);
    } else { f(); }
})(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="//mc.yandex.ru/watch/27119789" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->	