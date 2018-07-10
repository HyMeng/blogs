<?php
    header('content-type:text/html;charset=utf-8');
    include_once "../fn.php";

    $sql = "select * from users ";
    $data = my_query( $sql );
    echo json_encode($data);
?>