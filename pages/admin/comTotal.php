<?php 
    include_once "./fn.php";
    
    $sql = "select count(*) as total from comments join posts on comments.post_id = posts.id";

    $data = my_query($sql)[0];
    
    $data = json_encode($data);
    echo $data;

?>