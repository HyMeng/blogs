<?php 
  include_once './fn.php';
  isLogin();
  // session_start();
  $user_id = $_SESSION['user_id'];
  // 添加页面标识
  $page = 'users';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Users &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <script src="../assets/vendors/nprogress/nprogress.js"></script>
</head>
<body data-id = "<?php echo $user_id ?>">
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
      <div class="page-title">
        <h1>用户</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger box-notice" style="display:none;">
        <strong>错误！</strong><span id="msg"></span>
      </div>
      <div class="row">
        <div class="col-md-4">
          <form id="form">
            <h2>添加新用户</h2>
            <input type="hidden" name="id" id="id">
            <div class="form-group">
              <label for="image">头像</label>
              <!-- show when image chose -->
              <img class="help-block thumbnail" style="display: none">
              <input id="image" class="form-control" name="image" accept="image/jpeg, image/png ,image/gif" type="file">
            </div>
            <div class="form-group">
              <label for="email">邮箱</label>
              <input id="email" class="form-control" name="email" type="email" placeholder="邮箱">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/author/<strong id="strong"></strong></p>
            </div>
            <div class="form-group">
              <label for="nickname">昵称</label>
              <input id="nickname" class="form-control" name="nickname" type="text" placeholder="昵称">
            </div>
            <div class="form-group">
              <label for="password">密码</label>
              <input id="password" class="form-control" name="password" type="text" placeholder="密码">
            </div>
            <div class="form-group">              
              <input class="btn btn-primary btn-add" type="button"  value="添加">
              <input class="btn btn-primary btn-update" type="button" style="display:none;"  value="修改">
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm " id="box-dels" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
               <tr>
                <th class="text-center" width="40"><input type="checkbox" class="th-ck"></th>
                <th class="text-center" width="80">头像</th>
                <th>邮箱</th>
                <th>别名</th>
                <th>昵称</th>
                <th>状态</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- 引入侧边栏 -->
  <?php  include_once "./inc/include.php"?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/template/template-web.js"></script>
  <script>NProgress.done()</script>
  <script type="text/template" id="tep">
    {{ each list v i }}
      <tr>
        <td class="text-center" data-id = "{{ v.id }}"><input type="checkbox" class="tb-ck" {{ v.id == userId ? 'disabled' : 'undisabled'}}></td>
        <td class="text-center"><img class="avatar" src="../{{ v.avatar }}"></td>
        <td>{{ v.email }}</td>
        <td>{{ v.slug }}</td>
        <td>{{ v.nickname }}</td>
        <td>激活</td>
        <td class="text-left" data-id = {{ v.id }}>
          <a href="javascript:;" class="btn btn-default btn-xs btn-edit">编辑</a>
          {{ if v.id != userId }}
          <a href="javascript:;" class="btn btn-danger btn-xs btn-del">删除</a>
          {{ /if }}
        </td>
      </tr>
    {{ /each }}  
  </script>
  <script>
    $(function() {
      function render() {
        $.ajax({
          url: './users/userGet.php',
          dataType: 'json',
          success: function(info){
            console.log(info);
            var userId = $('body').attr('data-id');
            var obj = {
              list: info,
              userId : userId
            }
            var htmlStr = template('tep', obj);
            $('tbody').html( htmlStr );
          }
        })
      }
      render();
   //  #slug 和下面的strong 内容同步显示
    $('#slug').on('input', function(){
      $('#strong').text( $('#slug').val().trim() ) ;
      $('#slug').val() || $('#strong').text('slug');
    })
      // 添加用户功能
      $('.btn-add').click(function(){
        var formData = new FormData($('#form')[0]);
        $.ajax({
          type: 'post',
          url: './users/userAdd.php',
          data: formData,
          contentType: false,
          processData: false,
          beforeSend: function() {
            if( $('#text').val() == '' || $('#title').val() == ''|| $('#href').val() == '' ){
              $('.notice-msg').show();
              $('#msg').text('信息不能为空!');
              return false;
            }else{
              $('.notice-msg').hide();
            }
          },
          success: function(info){
            console.log(info);
            render();
            $('#form')[0].reset();
            $('#strong').text('slug');
          }
        })

      })
      // 点击编辑按钮功能 .btn-edit
      $('tbody').on( 'click' , '.btn-edit' ,function(info){
      var id = $(this).parent().attr('data-id');
      $.ajax({
        url: './users/userGetOne.php',
        data: { id : id },
        dataType: 'json',
        success: function( info ) {
          console.log(info);
          $('#email').val(info.email);
          $('#slug').val(info.slug);
          $('#password').val(info.password);
          $('#nickname').val(info.nickname);
          // 记录当前要修改的数据的id,后台接收后再根据这个id更新数据
          $('#id').val( info.id );
          $('#strong').text(info.slug);
          $('.btn-add').hide();
          $('.btn-update').show();
          // 注册点击修改事件
        $('.btn-update').click(function(){
          var formData = new FormData($('#form')[0]);
          $.ajax({
            type: 'post',
            url: './users/userUpdate.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function(info) {
              $('.btn-update').hide();
              $('.btn-add').show();
              render();
              $('#form')[0].reset(); 
              $('#strong').text('slug'); 
            }
          })
        })
        }
      })
    })
     // 点击单个删除按钮功能 .btn-del
     $('tbody').on('click','.btn-del',function(){
      var id = $(this).parent().attr('data-id');
      $.ajax({
        url: './users/userDel.php',
        data: {id: id},
        success: function() {
          render();
        }
      })
    })
      // 单选框功能和复选框功能
      $('tbody').on('change', '.tb-ck', function(){
          if($('.tb-ck:checked').length > 0){
            $('#box-dels').show();
          }else{
            $('#box-dels').hide();
          }
          if( $('.tb-ck').length === $('.tb-ck:checked').length ){
            $('.th-ck').prop('checked',true);
          }else {
            $('.th-ck').prop('checked',false);
          }
      })
      $('.th-ck').change( function() {
          $('.tb-ck').prop( 'checked', $(this).prop('checked') );
          if( $(this).prop('checked') ){
            $('#box-dels').show();
          }else {
            $('#box-dels').hide();
          }
      })
      // 点击多个删除按钮功能 
      $('#box-dels').click( function() {
          var arr = [];
          $('.tb-ck:checked').each( function( index, ele) {
              arr.push( $(ele).parent().attr('data-id'));
          })
          var str = arr.join();
          console.log(str);
          $.ajax({
            url: './users/userDel.php',
            data: {id: str},
            beforeSend: function() {
              if($('.th-ck').prop('checked')){ 
                return false;
              }
            },
            success: function() {
              render();
              $('#box-dels').hide();
              $('.th-ck').prop('checked',false);
            }
          })
      })

    })
  </script>
</body>
</html>
