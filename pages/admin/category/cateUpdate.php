<?php
    header('content-type:text/html;charset=utf-8');
    include_once "../fn.php";
    $id = $_POST['id'];
    echo $id;
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $sql = "update categories set name='$name',slug='$slug' where id = $id";
    my_exec( $sql );

?>