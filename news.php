<?php 
    //ini_set('display_errors', 'on');
    require_once("scripts/database.php");
    require_once("user.php");
    $db = new MySql("localhost", "ps", "psmysql01", "agregator");
    $db->connect();
    $user = new User();
    if (isset($_GET['id']) && preg_match('/[0-9]+/i', $_GET['id'])) {
        $db->query('SELECT `id`, `title`, DATE(`post_time`) as date, `tags`, `content` FROM `news` where `id`='.$_GET['id']);
        $news = $db->fetch_object();
        if ($news != null) {
            $news->content = str_replace('[cut]', '', $news->content);
            require('_news-full-template.php');
        } else {
            header('Location: news.php');
        }
    } elseif ($user->isNewsManager() && isset($_POST['title'])) {
    // } elseif (isset($_POST['title'])) {
        $title = $_POST['title'];
        $tags = $_POST['tags'];
        $content = $_POST['content'].'[cut]';
        $content = str_replace(PHP_EOL, '<br>', $content);
        $db->query("INSERT INTO `news` (`ID`, `title`, `post_time`, `tags`, `content`) VALUES (NULL, '$title', NULL, '$tags', '$content')");
        if (isset($_FILES['imgfile'])) {
            $type = split('\\.', $_FILES['imgfile']['name']);
            $type = $type[count($type) - 1];
        
            $insert_id = $db->insert_id();
            $imgName = $_SERVER['DOCUMENT_ROOT']."/img/news/$insert_id";
            move_uploaded_file($_FILES['imgfile']['tmp_name'], $imgName);
        }
        header('Location: news.php');
    } elseif ($user->isNewsManager() && isset($_POST['delete_id'])) {
        $db->query('DELETE FROM `news` where id='.$_POST['delete_id']);
        header('Location: news.php');
    } else {
        $page_size = 5;
        
        
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
        
        require('_news-template.php');
    }
?>