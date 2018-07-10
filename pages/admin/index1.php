<?php 
  include_once './fn.php';
  isLogin();
  // 添加页面标识
  $page = 'index';
  $sql = "select count(*) as total from posts";
  $posts = my_query( $sql )[0];
  $sql1 = "select count(*) as total from posts where status='drafted'";
  $drafted = my_query($sql1)[0];
  $sql2 = " select count(*) as total from categories";
  $categories = my_query($sql2)[0];
  $sql3 = " select count(*) as total from comments";
  $comments = my_query($sql3)[0];
  $sql4 = "select count(*) as total from comments where status='held'";
  $held = my_query($sql4)[0];
  echo '<pre>';
  print_r(json_encode($posts));
  echo '</pre>'; 
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Dashboard &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body>
  <script>NProgress.start()</script>

  <div class="main">
    <nav class="navbar">
      <button class="btn btn-default navbar-btn fa fa-bars"></button>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="profile.html"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="./logout.php"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="jumbotron text-center">
        <h1>One Belt, One Road</h1>
        <p>Thoughts, stories and ideas.</p>
        <p><a class="btn btn-primary btn-lg" href="post-add.php" role="button">写文章</a></p>
      </div>
      <div class="row">
        <div class="col-md-4">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">站点内容统计：</h3>
            </div>
            <ul class="list-group">
              <li class="list-group-item"><strong><?php echo $posts['total'] ?></strong>篇文章（<strong><?php echo $drafted['total'] ?></strong>篇草稿）</li>
              <li class="list-group-item"><strong><?php echo $categories['total'] ?></strong>个分类</li>
              <li class="list-group-item"><strong><?php echo $comments['total'] ?></strong>条评论（<strong><?php echo $held['total'] ?></strong>条待审核）</li>
            </ul>
          </div>
        </div>
        <div class="col-md-4"></div>
        <div class="col-md-4"></div>
      </div>
    </div>
  </div>

   <!-- 引入侧边栏 -->
   <?php  include_once "./inc/include.php"?>
   
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
</body>
</html>
