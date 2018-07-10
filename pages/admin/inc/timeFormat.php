<?php
    header('content-type:text/html;charset=utf-8');
    ini_set('date.timezone','Asia/Shanghai');
    $time = time();
    $date = date('Y-m-d H:i:s',$time);
    echo $date;
?>