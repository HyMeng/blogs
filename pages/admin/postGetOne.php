<?php 
    header('content-type:text/html;charset=utf-8');
    include_once "./fn.php";
    $id = $_GET['id'];
    // 查询id对应的文章数据,返回给前端
    $sql = "select * from posts where id='$id'";

    $data = my_query($sql)[0];

    echo json_encode( $data );

    

?>