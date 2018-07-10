<?php
    header('content-type:text/html;charset=utf-8');
    include_once "../fn.php";
    $id = $_GET['id'];
    $sql = "delete from users where id in ($id)";
    my_exec( $sql );

?>