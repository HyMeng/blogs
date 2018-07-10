<?php
    include_once "../fn.php";

    $sql = "select * from categories order by id desc";
   
    // 执行sql 语句,更新数据库
   $data = my_query($sql);

   echo json_encode( $data );

    



    


?>