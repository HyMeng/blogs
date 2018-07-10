<?php 
    header('content-type:text/html;charset=utf-8');
    // 根据前端传递的页码 和数据个数  返回对应数据
    include_once './fn.php';
    //起始索引 
    $id = $_GET['id'];
    //$sql 
    $sql = "delete from posts where id in ($id)";   
                    
    my_exec($sql);

    $sqlTotal = "select count(*) as total from posts join users on posts.user_id = users.id 
                join categories on posts.category_id = categories.id ";
    $data = my_query($sqlTotal)[0];
    echo json_encode($data); //返回json格式数据 
?>