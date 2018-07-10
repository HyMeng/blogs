<?php 
  include_once './fn.php';
  isLogin();
  // 添加页面标识
  $page = 'post-add';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Add new post &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <link rel="stylesheet" href="../assets/vendors/editor/wangEditor.css">
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
        <h1>写文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" action="./postAdd.php" method="post" enctype="multipart/form-data">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">标题</label>
            <textarea style="display:none;" id="content" class="form-control input-lg" name="content" cols="30" rows="10" placeholder="内容"></textarea>
            <!-- 富文本容器 -->
            <div id="content-box"></div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong>slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" style="display: none">
            <input id="feature" class="form-control" name="feature" type="file" accept="image/jpeg,image/gif">
          </div>
          <!-- 分类栏目 -->
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control" name="category">
              <!-- <option value="1">未分类</option>
              <option value="2">潮生活</option> -->
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <!-- 状态栏目 -->
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control" name="status">
              <!-- <option value="drafted">草稿</option>
              <option value="published">已发布</option> -->
            </select>
          </div>
          <div class="form-group">
            <button class="btn btn-primary" type="submit">保存</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <!-- 引入侧边栏 -->
  <?php  include_once "./inc/include.php"?>
  
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script src="../assets/vendors/template/template-web.js"></script>
  <script src="../assets/vendors/editor/wangEditor.min.js"></script>
  <!-- 引入时间格式化插件 -->
  <script src="../assets/vendors/moment/moment.js"></script>
  <script>NProgress.done()</script>
   <!-- 创建模板 -->
  <script id="tep" type="text/template">
    {{ each list v i}}
    <option value="{{ v.id }}">{{ v.name }}</option>
    {{ /each }}
  </script>
  <!-- <script id="tep-state" type="text/template">
    {{ each list v i}}
    <option value="{{ v.status }}">{{ state[v.status] }}</option>
    {{ /each }}
  </script> -->

  <script id="tep-state" type="text/template">
    {{ each obj v k}}
    <option value="{{ k }}">{{ v }}</option>
    {{ /each }}
  </script>
  <script>
    $(function(){
      var E = window.wangEditor;
      var editor = new E('#content-box');
      editor.customConfig.onchange = function (html) {
            // 监控变化，同步更新到 textarea
            $('#content').val(html);
        }
      editor.create();
      // $('#content').val(editor.txt.html()); 初始化文本框的内容
        // 获取input#slug里的内容,并添加到下面的p标签后面
      $('#slug').on('input',function() {
          $(".help-block").children('strong').text( $(this).val() || 'slug' );
      }) 
            // 当文件域文件选择发生改变过后，本地预览选择的图片
      $('#feature').on('change', function () {
        var file = this.files[0];
        // console.log(this.files);
        
        // 为这个文件对象创建一个 Object URL
        var url = URL.createObjectURL(file);
        // 将图片元素显示到界面上（预览）
        $(this).siblings('.thumbnail').attr('src', url).fadeIn();
        $(this).siblings('.thumbnail').css({width:'100px',height:'100px'});
    })
      // 发布时间初始值
      // moment(时间).format('格式')；
      // Y年 M月 D日 h时 m分 s秒 

      $('#created').val(moment().format('YYYY-MM-DDTHH:mm'));
        // 5 -分类数据动态渲染
        function render() {
            $.ajax({
              url:'./postSelect.php',
              dataType: 'json',
              success: function(info){
                console.log(info);
                var obj = {
                  list: info
                }
                var html = template('tep', obj);
                $('#category').html(  html );
              }
            })

        }
        render();
  
        

        // 6- 状态数据动态渲染 
            //草稿（drafted）/ 已发布（published）/ 回收站（trashed）
        // var state = {
        //   drafted : '草稿',
        //   published: '已发布',
        //   trashed : '回收站'
        // } 
        // var obj = {
        //   list: [{status:'drafted'},{status:'published'},{status:'trashed'}],
        //   state: state
        // }
        // var html = template('tep-state', obj);
        // $('#status').html(  html );

        var state = {
          drafted : '草稿',
          published: '已发布',
          trashed : '回收站'
        }
        var html = template('tep-state', {obj : state});
        $('#status').html(  html );
  })
  </script>
</body>
</html>
