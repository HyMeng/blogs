<style>
    .edit-box{
        position:fixed;
        left:0;
        top:0;
        width:100%;
        height:100%;
        background:rgba(0,0,0,0.7);
        z-index:10;
        padding:50px 50px;
        display:none;
    }

    .container-fluid{
        background: #eee;
        border-radius:10px;
        padding-bottom:20px;
    }

    /* .my-in {
      background: pink;
      height800px;
    } */
</style>

<div class="edit-box">
    <div class="container-fluid my-in">
      <div class="page-title">
        <h1>修改文章</h1>
      </div>
      <!-- 有错误信息时展示 -->
      <!-- <div class="alert alert-danger">
        <strong>错误！</strong>发生XXX错误
      </div> -->
      <form class="row" id="editForm" >
        <!-- 隐藏域  -->
        <input type="hidden"  id="id" name="id" value="">
        <div class="col-md-9">
          <div class="form-group">
            <label for="title">标题</label>
            <input id="title" class="form-control input-lg" name="title" type="text" placeholder="文章标题">
          </div>
          <div class="form-group">
            <label for="content">正文</label>
            <textarea id="content" class="form-control input-lg"
               name="content" cols="30" rows="10" placeholder="内容" style="display:none"></textarea>
                <!-- 生成富文本编辑器容器 -->
               <div id="content-box"></div> 
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
            <label for="slug">别名</label>
            <input id="slug" class="form-control" name="slug" type="text" placeholder="slug">
            <p class="help-block">https://zce.me/post/<strong id="strong">slug</strong></p>
          </div>
          <div class="form-group">
            <label for="feature">特色图像</label>
            <!-- show when image chose -->
            <img class="help-block thumbnail" id="img" style="display: none;width:60px;">
            <!--  accept="image/jpeg,image/gif,image/png" 限制上传文件格式 -->
            <input id="feature" class="form-control" name="feature" type="file" accept="image/jpeg,image/gif,image/png">
          </div>
          <div class="form-group">
            <label for="category">所属分类</label>
            <select id="category" class="form-control sel-cate sel-cate1" name="category">     
            </select>
          </div>
          <div class="form-group">
            <label for="created">发布时间</label>
            <input id="created" class="form-control" name="created" type="datetime-local">
          </div>
          <div class="form-group">
            <label for="status">状态</label>
            <select id="status" class="form-control sel-state sel-state1" name="status">
            </select>
          </div>
          <div class="form-group">
            <!-- <button class="btn btn-primary" >修改</button> -->
            <input  id="btn-update" type="button" value="修改"  class="btn btn-primary btn-update" >
            <input  id="btn-cancel" type="button" value="放弃"  class="btn btn-danger btn-cancel" >
          </div>
        </div>
      </form>
    </div>
</div>
<script src="../assets/vendors/jquery/jquery.js"></script>
<script src="../assets/vendors/editor/wangEditor.min.js"></script>
<script src="../assets/vendors/template/template-web.js"></script>
<!-- 引入时间格式化插件 -->
<script src="../assets/vendors/moment/moment.js"></script>

<!-- 创建模板 -->
<script id="tep-cate" type="text/template">
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
        function cateGory() {
            $.ajax({
              url:'./postSelect.php',
              dataType: 'json',
              success: function(info){
                // console.log(info);
                var obj = {
                  list: info
                }
                var html = template('tep-cate', obj);
                $('#category').html(  html );
              }
            })

        }
        cateGory();
  
        

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

        var sta = {
          drafted : '草稿',
          published: '已发布',
          trashed : '回收站'
        }
        var html = template('tep-state', {obj : sta});
        $('#status').html(  html );
  })
  </script>


