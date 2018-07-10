<?php
    include_once "./fn.php";
    $id = $_GET['id'];
    $sql = "update comments set status='approved' where id in ($id)";
   
    // 执行sql 语句,更新数据库
    my_exec( $sql );
    



    


?>