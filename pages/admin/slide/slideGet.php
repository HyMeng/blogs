<?php
    header('content-type:text/html;charset=utf-8');
    include_once "../fn.php";

    $sql = "select value from options where id=10";
    $data = my_query( $sql )[0]['value'];
    echo $data;
?>