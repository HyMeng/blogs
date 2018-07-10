<?php
    header('content-type:text/html;charset=utf-8');
    include_once "../fn.php";
    $icon = ['fa fa-glass','fa fa-fire','fa fa-gift','fa fa-fire'];
    $info['icon'] = $icon[rand(0,3)];
    $info['text'] = $_POST['text'];
    $info['title'] = $_POST['title'];
    $info['link'] = $_POST['href'];
    $sql = "select value from options where id=9";
    $data = my_query( $sql )[0]['value'];
    $arr = json_decode($data , true);
    $arr[] = $info;
    $jsonStr = json_encode($arr);
    $sqlUpdate = "update options set value = '$jsonStr' where id = 9 ";
    my_exec($sqlUpdate);
?>