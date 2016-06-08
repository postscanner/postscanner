<?php
    $q = $_POST["q"];
    $arr = array(
    array("id" => "1",
          "text" => $q."123"));
    echo json_encode($arr);
?>
