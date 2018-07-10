<?php
    include_once "../fn.php";
    $id = $_GET['id'];
    $sql = "select * from categories where id = $id ";
   
    // 执行sql 语句,更新数据库
   $data = my_query($sql)[0];

   echo json_encode( $data );
?>