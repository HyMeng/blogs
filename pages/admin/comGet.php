<?php
  include_once "./fn.php";
  $pages = $_GET['pages'];
  $pagesize = $_GET['pageSize'];
  $start = ($pages -1) * $pagesize; 
  $sql = "select comments.*,posts.title from comments join posts
   on comments.post_id = posts.id limit $start,$pagesize";
  $data = my_query($sql);
  $jsonstr = json_encode($data);
  echo $jsonstr;  

?>