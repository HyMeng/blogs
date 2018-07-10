<?php
        include_once "./fn.php";
        $id = $_GET['id'];
        $sql = "delete from comments where id in ($id)";
       
        // 执行sql 语句,更新数据库
        my_exec( $sql );
        // 删除数据会导致数据库信息总条数发生变化,故应该重新计算data的总条数,返回total给前端,进行重新渲染
        $sql1 = "select count(*) as total from comments join posts on comments.post_id = posts.id ";
        $data =  my_query($sql1)[0];
        $data = json_encode( $data );
        echo $data;
        

?>