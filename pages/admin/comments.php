<?php 
  include_once "./fn.php";
  isLogin();
  $page = 'comments';

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>Comments &laquo; Admin</title>
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
        <h1>所有评论</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <div class="page-action">
        <!-- show when multiple checked -->
        <div class="btn-batch" style="display: none">
          <button class="btn btn-info btn-sm btn-approveds">批量批准</button>
          <button class="btn btn-warning btn-sm">批量拒绝</button>
          <button class="btn btn-danger btn-sm btn-del">批量删除</button>
        </div>
        <div class="page_box pull-right"></div>
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
            <th class="text-center" width="40"><input class="th-ck" type="checkbox"></th>
            <th>作者</th>
            <th>评论</th>
            <th>评论在</th>
            <th>提交于</th>
            <th>状态</th>
            <th class="text-center" width="100">操作</th>
          </tr>
        </thead>
        <tbody>
          <!-- <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>未批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-info btn-xs">批准</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr>
          <tr>
            <td class="text-center"><input type="checkbox"></td>
            <td>大大</td>
            <td>楼主好人，顶一个</td>
            <td>《Hello world》</td>
            <td>2016/10/07</td>
            <td>已批准</td>
            <td class="text-center">
              <a href="post-add.html" class="btn btn-warning btn-xs">驳回</a>
              <a href="javascript:;" class="btn btn-danger btn-xs">删除</a>
            </td>
          </tr> -->
        </tbody>
      </table>
    </div>
  </div>

  <!-- 引入侧边栏 -->
  <?php  include_once "./inc/include.php"?>
   
  <script src="../assets/vendors/jquery/jquery.js"></script>
  <script src="../assets/vendors/bootstrap/js/bootstrap.js"></script>
  <script>NProgress.done()</script>
  <!-- 引入模板js包 -->
  <script src="../assets/vendors/template/template-web.js"></script>
  <script src="../assets/vendors/pagination/jquery.pagination.js"></script>
  <!-- 创建模板 -->
  <script id="tep" type="text/template">
    {{ each list v i}}
      <tr>
                <td class="text-center" data-id ={{ v.id }}><input  class="tb-ck" type="checkbox"></td>
                <td>{{ v.author }}</td>
                <td>{{ v.content.substr(0,30) + "..." }}</td>
                <td>《{{ v.title }}》</td>
                <td>{{ v.created }}</td>
                <td>{{ state[v.status] }}</td>
                <td class="text-right" data-id ={{ v.id }}>
                {{ if( v.status === 'held' ) }}
                  <a href="javascript:;" class="btn btn-info btn-xs btn-approved">批准</a>
                {{ /if }}
                  <a href="javascript:;" class="btn btn-danger btn-xs btn-delete">删除</a>
                </td>
      </tr>
    {{ /each }}
  </script>
  <script>

      $(function(){
        // $tbody = $('tbody');
        //待审核（held）/ 准许（approved）/ 拒绝（rejected）/ 回收站（trashed）
        var state = {
          held: '待审核',
          approved: '准许',
          rejected: '拒绝',
          trashed: '回收站'
        }
        // 定义一个存储当前页面的全局变量
        var currentPage = 1;
    //held  state['held']
      //1- 获取第一屏的数据渲染在页面中 
      function render(page,pageSize){
          $.ajax({
          url: './comGet.php',
          data: {
            pages: page || 1,
            pageSize: pageSize || 10
          },
          dataType: 'json',
          success: function (info) {
           // console.log(info); //数组
            var obj = { 
              list: info,
              state: state  //把全局state 传递给模板使用
            }
            var str = template('tep', obj); //生成结构
            $('tbody').html(str); //放到页面中          
          }
        })
        $('.th-ck').prop('checked',false);
        $('.btn-batch').hide();
      }
       //1- 获取第一屏的数据渲染在页面中 
      render();
      // 引入一个pagnation插件
      function setPage(page){
          $.ajax({
            url: './comTotal.php',
            dataType: 'json',
            success: function(info){
              // console.log(info);
               //2-根据总数生成分页标签
               $('.page_box').pagination(info.total,{
                  prev_text: '<<上一页',
                  next_text: '下一页>>',
                  num_display_entries: 8, //连续主体个数
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
      // 给批准按钮的父级元素注册点击事件,通过事件委托来实现更新当前页面数据
      $('tbody').on("click", ".btn-approved", function(){
        var $id = $(this).parent('td').attr('data-id');
        // console.log($id);
        $.ajax({
          type: 'get',
          url: './comApproved.php',
          data: {
            id: $id
          },
          // dataType: 'json',
          success: function(info){
            // 渲染当前页面数据
            render( currentPage );
          }
        })
        
      })
      //5-删除评论
      // 1- 点击删除按钮，获取对应数据id ，传给后台 
      // 2- 后台获取id,根据id进行删除
      // 3- 删除完成后，重新渲染当前页 （currentPage) 
      //删除完成后数据总数发生变化，要重新生成分页标签
      $('tbody').on('click','.btn-delete', function(){
        var $id = $(this).parent('td').attr('data-id');
        // console.log($id);
        $.ajax({
          type: 'get',
          url: './comDel.php',
          data: {
            id: $id
          },
          dataType: 'json',
          success: function(info){
            //根据数据库总数计算出 最大的页码
            var maxPage = Math.ceil(info.total / 10);
            console.log(maxPage);
            console.log(currentPage);
            // 如果最后一页点击删除到最后一项,此时渲染的是最大页面,可是此时最大页码小于当前页码
            // 所以渲染失败.页面一直刷新不出
            if(currentPage > maxPage){
              currentPage = maxPage;
            }
            // 渲染当前页面数据
            render( currentPage );
            setPage( currentPage );
          }
        })


      })
      // 复选框批量选中
      //6-全选功能
      //1-让下面小复选框的选中状态 和 全选按钮一致
      //2-控制批量按钮显示和隐藏
      // btn-batch
      $('.th-ck').change(function(){
        var value = $('.th-ck').prop('checked');
        $('.tb-ck').prop('checked',value);
        if(value){
          $('.btn-batch').show();
        }else {
          $('.btn-batch').hide();
        }
      } )
      //7-多选功能
      //1-所有小复选框全部选中，则全选按钮选中，否则取消
      //2-有小复选框被选中，批量按钮显示，否则隐藏
      $('tbody').on('change','.tb-ck',function(){
        // console.log($('.tb-ck').length);
        // console.log($('.tb-ck:checked').length);
        if($('.tb-ck').length === $('.tb-ck:checked').length){
          $('.th-ck').prop('checked',true);
        }else{
          $('.th-ck').prop('checked',false);
        }
        if( $('.tb-ck:checked').length > 0){
          $('.btn-batch').show();
        }else {
          $('.btn-batch').hide();
        }

      })

      function getId() {
        var ids = [];
        $('.tb-ck:checked').each(function( index, ele ) {
            ids.push( $(this).parent().attr('data-id') );
        })
         var ids = ids.join();
        //  console.log(ids);
         return ids;
        
      }

      $('.btn-approveds').click(function(){
        var ids = getId();
          $.ajax({
            url: './comApproved.php',
            data: {
              id: ids
            },
            success: function(){
              render( currentPage );
            }
            
          })
      })

      $('.btn-del').click(function(){
        var ids = getId();
          $.ajax({
            url: './comDel.php',
            data: {
              id: ids
            },
            dataType: 'json',
            success: function(info){
              var maxPage = Math.ceil(info.total / 10);
              console.log(maxPage);
              console.log(currentPage);
              // 如果最后一页点击删除到最后一项,此时渲染的是最大页面,可是此时最大页码小于当前页码
              // 所以渲染失败.页面一直刷新不出
              if(currentPage > maxPage){
                currentPage = maxPage;
              }
              
              render( currentPage );
              setPage( currentPage );
            }
            
          })
      })



    
    }) 
  </script>


</body>
</html>
