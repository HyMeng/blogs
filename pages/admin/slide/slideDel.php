<?php 
    header('content-type:text/html;charset=utf-8');
    include_once "../fn.php";
    $id = $_GET['id'];
    $sql = "select value from options where id = 10";
    $data = my_query($sql)[0]['value'];
    // echo $data;
    $arr = json_decode($data , true );
    array_splice( $arr, $id, 1 );
    $data = json_encode($arr);
    // echo '<pre>';
    // print_r($data);
    // echo '</pre>';
    $sqlDel = "update options set value = '$data' where id = 10";
    // echo $sqlDel;
    my_exec($sqlDel);
?>