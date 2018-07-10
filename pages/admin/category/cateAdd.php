<?php
    header('content-type:text/html;charset=utf-8');
    include_once "../fn.php";
    $name = $_GET['name'];
    $slug = $_GET['slug'];
    $sql = "insert into categories (name , slug) values ( '$name' ,'$slug')";
    my_exec( $sql );

?>