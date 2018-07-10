<?php 
  include_once "./fn.php";
  isLogin();
  $page = 'categories';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Categories &laquo; Admin</title>
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
      <div class="page-title">
        <h1>分类目录</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="row">
        <div class="col-md-4">
          <form id="form">
            <h2>添加新分类目录</h2>
            <input type="hidden" id="id" name="id" value="">
            <div class="form-group">
              <label for="name">名称</label>
              <input id="name" class="form-control" name="name" type="text" placeholder="分类名称">
            </div>
            <div class="form-group">
              <label for="slug">别名</label>
              <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
              <p class="help-block">https://zce.me/category/<strong id="strong">slug</strong></p>
            </div>
            <div class="form-group">              
              <input type="button" class="btn btn-primary btn-add" value="添加">
              <input type="button" class="btn btn-primary btn-update" style="display: none;" value="修改">
            </div>
          </form>
        </div>
        <div class="col-md-8">
          <div class="page-action">
            <!-- show when multiple checked -->
            <a class="btn btn-danger btn-sm"  id="box-dels" href="javascript:;" style="display: none">批量删除</a>
          </div>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th class="text-center" width="40"><input type="checkbox" class="th-ck"></th>
                <th>名称</th>
                <th>Slug</th>
                <th class="text-center" width="100">操作</th>
              </tr>
            </thead>
            <tbody>
              <!-- <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr>
              <tr>
                <td class="text-center"><input type="checkbox"></td>
                <td>未分类</td>
                <td>uncategorized</td>
                <td class="text-center">
                  <a href="javascript:;" class="btn btn-info btn-xs">编辑</a>
                  <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
                </td>
              </tr> -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- 引入侧边栏 -->
  <?php  include_once "./inc/include.php"?>

  <script src="../assets/vendors/jquery/jquery.js"></script>
  <!-- 引入模板js -->
  <script src="../assets/vendors/template/template-web.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <script type="text/template" id="tep">
    {{ each list v i }}
      <tr>
          <td class="text-center" data-id={{ v.id }}><input type="checkbox" class="tb-ck"></td>
          <td>{{ v.name }}</td>
          <td>{{ v.slug }}</td>
          <td class="text-center" data-id={{ v.id }}>
            <a href="javascript:;" class="btn btn-info btn-xs btn-edit">编辑</a>
            <a href="javascript:;" class="btn btn-danger btn-xs btn-del">删除</a>
          </td>
      </tr>
    {{ /each }} 
  </script>
  <script>
    $(function() {
     
     function render(){
        $.ajax({
        url: './category/cateGet.php',
        dataType: 'json',
        success: function(info) {
          console.log(info);
          $("tbody").html( template('tep',{list: info} ));
          
        }
      })
    }
    render();
    // 添加功能
    $('.btn-add').click(function( ){
      var data = $('#form').serialize();
      $.ajax({
        url: './category/cateAdd.php',
        data: data,
        success: function( info ) {
          render();
          $('#form')[0].reset();
          
        }
      })
    })
    // 点击编辑按钮功能 .btn-edit
     //  #slug 和下面的strong 内容同步显示
    $('#slug').on('input', function(){
      $('#strong').text( $('#slug').val().trim() ) ;
      $('#slug').val() || $('#strong').text('slug');
    })
    $('tbody').on( 'click' , '.btn-edit' ,function(info){
      var id = $(this).parent().attr('data-id');
      $.ajax({
        url: './category/cateGetOne.php',
        data: { id : id },
        dataType: 'json',
        success: function( info ) {
          console.log(info);
          $('#name').val(info.name);
          $('#slug').val(info.slug);
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
              url: './category/cateUpdate.php',
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
        url: './category/cateDel.php',
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
            url: './category/cateDel.php',
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
