<?php 
  include_once './fn.php';
  isLogin();
  // 添加页面标识
  $page = 'nav-menus';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Navigation menus &laquo; Admin</title>
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
        <li><a href="profile.php"><i class="fa fa-user"></i>个人中心</a></li>
        <li><a href="./logout.php"><i class="fa fa-sign-out"></i>退出</a></li>
      </ul>
    </nav>
    <div class="container-fluid">
      <div class="page-title">
        <h1>导航菜单</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <div class="alert alert-danger notice-msg" style="display:none;">
        <strong>错误！</strong><span id="msg"></span>
      </div>
      <div class="row">
        <div class="col-md-4">
          <form id="form">
            <h2>添加新导航链接</h2>
            <div class="form-group">
              <label for="text">文本</label>
              <input id="text" class="form-control" name="text" type="text" placeholder="文本">
            </div>
            <div class="form-group">
              <label for="title">标题</label>
              <input id="title" class="form-control" name="title" type="text" placeholder="标题">
            </div>
            <div class="form-group">
              <label for="href">链接</label>
              <input id="href" class="form-control" name="href" type="text" placeholder="链接">
            </div>
            <div class="form-group">
              <input class="btn btn-primary btn-add" type="button" value="添加">
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>               
                <th>文本</th>
                <th>标题</th>
                <th>链接</th>
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
    <!-- 引入模板引擎 -->
  <script src="../assets/vendors/template/template-web.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/template" id="tep">
    {{ each list v i }}
    <tr>               
        <td><i class="{{v.icon}}"></i>{{v.text }}</td>
        <td>{{ v.title }}</td>
        <td>{{ v.link }}</td>
        <td class="text-center" data-id={{ i }}>
          <a href="javascript:;" class="btn btn-danger btn-xs btn-del">删除</a>
        </td>
    </tr>
    {{ /each }}
  </script>
  <script>
    $(function(){
      function render() {
        $.ajax({
          url: './nav-menu/navGet.php',
          dataType: 'json',
          success: function(info) {
            //  console.log(info);
            $('tbody').html(template('tep',{list : info})); 
          }
        })
      }
      render();
      // 添加菜单栏.btn-add
      $('.btn-add').click(function(){

      var formData = new FormData($('#form')[0]);
      $.ajax({
          type: 'post',
          url: './nav-menu/navAdd.php',
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
          success: function(info) {
             render();
             $('#form')[0].reset();
          }
        })
          
      })
      // 删除功能
      $('tbody').on('click','.btn-del',function(){
          var id = $(this).parent().attr('data-id');
          $.ajax({
            url: './nav-menu/navDel.php',
            data: {id : id},
            success: function(info) {
              render();
            }
          })


      })


    })

  </script>
</body>
</html>
