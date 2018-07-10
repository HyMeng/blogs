<?php
    header('content-type:text/html;charset=utf-8');
    include_once "../fn.php";
    $id = $_GET['id'];
    $sql = "select value from options where id=9";
    $data = my_query( $sql )[0]['value'];
    $arr = json_decode($data , true);
    array_splice($arr, $id , 1);
    $jsonStr = json_encode($arr);
    $sqlUpdate = "update options set value = '$jsonStr' where id = 9 ";
    my_exec($sqlUpdate);
?>