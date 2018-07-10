<?php
  if( !empty($_POST) ){
    include_once "./fn.php";
    $email = $_POST['email'];
    $password = $_POST['password'];
    echo '<pre>';
    print_r($_POST);
    echo '</pre>';

    if( empty($email) || empty($password)){
      $msg = "用户名或密码不能为空";
    }
    else{
      $sql = "select * from users where email='$email'";
      $data = my_query($sql);
      if(empty($data)){
        $msg = "用户名不存在";
      }else{
        $data = $data[0]; // 返回一个一维数组
        if($password == $data['password']){
          session_start();
          $_SESSION['user_id'] = $data['id'];
          // echo '<pre>';
          // print_r($_SESSION);
          // echo '</pre>';
          header("location:./index1.php");
        }else{
          $msg = '密码错误';
        }
      }


    }
  } 




?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Sign in &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
  <div class="login">
    <form class="login-wrap" action="" method="post">
      <img class="avatar" src="../assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php if(isset($msg)){ ?>
      <div class="alert alert-danger">
        <strong>错误！</strong> <?php echo $msg?>
      </div>
      <?php }?>
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name="email" value="<?php echo isset($msg) ? $email : ''; ?>" type="email" class="form-control" placeholder="邮箱" autofocus>
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password" name="password" type="password" class="form-control" placeholder="密码">
      </div>     
      <input  class="btn btn-primary btn-block" type="submit" value="登录">
    </form>
  </div>
</body>
</html>
