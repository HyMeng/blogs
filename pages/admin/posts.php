<?php 
  include_once './fn.php';
  isLogin();
  // 添加页面标识
  $page = 'posts';
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Posts &laquo; Admin</title>
  <link rel="stylesheet" href="../assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../assets/vendors/nprogress/nprogress.css">
  <link rel="stylesheet" href="../assets/css/admin.css">
  <link rel="stylesheet" href="../assets/vendors/pagination/pagination.css">
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
        <h1>所有文章</h1>
        <a href="post-add.php" class="btn btn-primary btn-xs">写文章</a>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <a class="btn btn-danger btn-sm btn-dels" href="javascript:;" style="display: none">批量删除</a>
        <!-- 引入分页盒子 -->
        <div class="page-box pull-right"></div>
        <!-- <ul class="pagination pagination-sm pull-right">
          <li><a href="#">上一页</a></li>
          <li><a href="#">1</a></li>
          <li><a href="#">2</a></li>
          <li><a href="#">3</a></li>
          <li><a href="#">下一页</a></li>
        </ul> -->
      </div>
      <table class="table table-striped table-bordered table-hover">
        <thead>
          <tr>
            <th class="text-center" width="40"><input type="checkbox" class="th-ck"></th>
            <th>标题</th>
            <th>作者</th>
            <th>分类</th>
            <th class="text-center">发表时间</th>
            <th class="text-center">状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <!-- <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>随便一个名称</td>
            <td>小小</td>
            <td>潮科技</td>
            <td class="text-center">2016/10/07</td>
            <td class="text-center">已发布</td>
            <td class="text-center">
              <a href="javascript:;" class="btn btn-default btn-xs">编辑</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr> -->
         
        </tbody>
      </table>
    </div>
  </div>

  <!-- 引入侧边栏 -->
  <?php  include_once "./inc/include.php"?>
  <!-- 引入模态框 -->
  <?php  include_once "./inc/edit.php"?>
  
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <!-- 引入模板js包 -->
  <script src="../assets/vendors/template/template-web.js"></script>
  <script src="../assets/vendors/pagination/jquery.pagination.js"></script>
  <script>NProgress.done()</script>
  <script>
    $(function(){
     // 封装渲染页面的函数
    var currentPage = 1;
    function render( page, pageSize ) {
    //草稿（drafted）/ 已发布（published）/ 回收站（trashed）
      var state = {
         drafted: '草稿',
         published: '已发布',
         trashed: '回收站'
      }
      $.ajax({
        url: './postGet.php',
        data: {
          page: page || 1,
          pageSize: pageSize || 10
        },
        dataType: 'json',
        success: function(info){
          // console.log( info );
          var obj = {
            list: info,
            state: state
          }
          var html = template('tep', obj);
          $('tbody').html( html );
        }
      })
      $('.th-ck').prop('checked',false);
      $('.btn-dels').hide();

    }
    render();
    // 封装设置分页栏目的函数
    function setPage(page) {
      $.ajax({
        url: './postTotal.php',
        dataType: 'json',
        success: function(info){
          // console.log(info);
          $(".page-box").pagination(info.total, {
              prev_text: '<<',
              next_text: '>>',
              num_display_entries: 6, //连续主体个数
              num_edge_entries:1, //收尾显示个数
              current_page: page - 1 || 0, //默认选中的页码
              load_first_page: false, //页码刷新时回调函数不执行
              callback: function(index){
                // console.log(index);
                render( index + 1 );
                // 记录点击后的页面数
                currentPage = index + 1;
              }
          })
        }
      })
    }
    setPage();
    // 单个删除功能 
     $('tbody').on( 'click', '.btn-del', function(){
       var id = $(this).parent().data('id');
       $.ajax({
         url: './postDel.php',
         data: {
           id : id,
         },
         dataType: 'json',
         success: function(info) {
          //  console.log(info);
            var maxPage = Math.ceil( info.total / 10 );
            if( currentPage > maxPage ){
              currentPage = maxPage;
            }
            render( currentPage );
            setPage( currentPage );
         }
       })
      
     })
    // 单选框功能btn-dels
     $('tbody').on('change', '.tb-ck',function(){
       if( $('.tb-ck:checked').length > 0 ){
         $('.btn-dels').show();
       }else {
         $('.btn-dels').hide();
       }
       if( $('.tb-ck').length === $('.tb-ck:checked').length ){
         $('.th-ck').prop('checked',true);
       }else {
         $('.th-ck').prop('checked',false);
       }
     })
    // 复选框功能btn-dels
     $('.th-ck').click( function() {
        var value = $(this).prop('checked');
        $('.tb-ck').prop('checked', value);
        if( value ) {
          $('.btn-dels').show();
        } else {
          $('.btn-dels').hide();
        }
     })

     function getId(){
       var ids = [];
       $('.tb-ck:checked').each(function(index,ele){
         ids.push( $(ele).parent().data('id'));
       })

       return ids.join();
     }
     //复选框多选删除posts功能
     $('.btn-dels').click( function() {
        var ids = getId();
        // console.log(ids);
        $.ajax({
          url: './postDel.php',
          data: {
            id : ids
          },
          dataType : 'json',
          success: function( info ) {
            var maxPage = Math.ceil( info.total / 10);
            if( currentPage > maxPage ) {
              currentPage = maxPage;
            }
            render( currentPage );
            setPage( currentPage );
          }
        })
     })

    // 点击编辑功能 .btn-editor
    // .edit-box
    $('tbody').on( 'click','.btn-editor', function(){
      $(".edit-box").show();
      var id = $(this).parent().data('id');
       $.ajax({
         url: './postGetOne.php',
         data: {
           id : id,
         },
         dataType: 'json',
         success: function( info ) {
           console.log(info);
            $("#title").val(info.title);
            var E = window.wangEditor
            var editor = new E('#content-box')
            editor.customConfig.onchange = function (html) {
         // 监控变化，同步更新到 textarea
            $('#content').val(html);
        }
           editor.create();
        // 把要修改的文章内容填写到编辑器中
            $('#content').val(editor.txt.html(info.content));

            $("#slug").val(info.slug);

            $(".help-block").children('strong').text( info.slug );
            $('#img').attr('src','../' + info.feature).show();
            // 分类框默认选中#category
            $('#category option[value=' + info.category_id +']').prop('selected', true);

            // 状态框默认选中#status
            $('#status option[value=' + info.status +']').prop('selected', true);
            // - 设置id      
            $('#id').val(info.id);  
         }
    })
  })

    // 点击取消编辑功能  .btn-cancel
      $('.btn-cancel').click(function(){
        $(".edit-box").hide();
      })

    
    //  点击修改功能 .btn-update
    $('.btn-update').click(function(){
      // #editForm
      var formData = new FormData( $('#editForm')[0] );
      
      $.ajax({
         type: 'post',
         url: './postUpdate.php',
         data: formData,
         contentType: false,  
         processData: false,  //不需要对数据进行编码
         success: function(info){
          //  console.log('haha')
          render( currentPage );
          $('.edit-box').hide();
         }

      })

    })
  })

  </script>
  <!-- 创建模板 -->
  <script type="text/template" id="tep">
  {{ each list v i }}
    <tr>
        <td class="text-center"  data-id = "{{ v.id }}"><input type="checkbox" class= "tb-ck"></td>
        <td>{{ v.title }}</td>
        <td>{{ v.nickname }}</td>
        <td>{{ v.name }}</td>
        <td class="text-center">{{ v.created }}</td>
        <td class="text-center">{{ state[v.status] }}</td>
        <td class="text-center" data-id="{{ v.id }}">
          <a href="javascript:;" class="btn btn-default btn-xs btn-editor">编辑</a>
          <a href="javascript:;" class="btn btn-danger btn-xs btn-del">删除</a>
        </td>
    </tr>
  {{ /each }}
  </script>

</body>
</html>
