<?php
  // aside只是一个模块侧边栏，不是一个页面
  //1-显示当前登录用户头像和昵称
  $id = $_SESSION['user_id'];
    //2-根据用户id 获取当用户信息
  $sql = "select * from users where id = $id";
  $nickname = my_query($sql)[0]['nickname'];
  $photo = my_query($sql)[0]['avatar'];
   // echo '<pre>';
  // print_r($photo);
  // echo '</pre>';
  //如果是文章模块
  //文章模块整体要高亮显示 ，箭头向下， ul张开，小li高亮显示
  //$isPost = $page == 'categories' || $page == 'posts' || $pages == 'post-add';
  // in_array(a, b); 判断数据a 是否在数组b中
  $isPost = in_array($page,["categories","posts","post-add"]);
  $isSet = in_array($page,['nav-menus','slides','settings']);

?>
<div class="aside">
    <div class="profile">
      <img class="avatar" src="../<?php echo $photo ?>">
      <h3 class="name"><?php echo $nickname ?></h3>
    </div>
    <ul class="nav">
      <li class="<?php echo $page==='index' ? 'active':'' ?>">
        <a href="index1.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <!-- 文章栏目 -->
      <li class="<?php echo $isPost ? 'active': '' ?>" >
            <!-- 有这个 class="collapsed"  让箭头向右  -->
        <a href="#menu-posts" data-toggle="collapse" class="<?php echo $isPost?'':'collapsed' ?>" >
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
          <!-- ul的in类名 控制列表展开和折叠 -->
        <ul id="menu-posts" class="collapse  <?php echo $isPost ? 'in': '' ?>">
          <li class="<?php echo $page==='posts' ? 'active':'' ?>"><a href="posts.php">所有文章</a></li>
          <li class="<?php echo $page==='post-add' ? 'active':'' ?>"><a href="post-add.php">写文章</a></li>
          <li class="<?php echo $page==='categories' ? 'active':'' ?>"><a href="categories.php">分类目录</a></li>
        </ul>
      </li>
      <li class="<?php echo $page==='comments' ? 'active':'' ?>">
        <a href="comments.php"><i class="fa fa-comments"></i>评论</a>
      </li>
      <li  class="<?php echo $page==='users' ? 'active':'' ?>">
        <a href="users.php"><i class="fa fa-users"></i>用户</a>
      </li>
     <!-- 设置栏 -->
      <li class="<?php echo $isSet ? 'active': '' ?>" >
        <a href="#menu-settings" class="<?php echo $isSet ?'':'collapsed' ?>" data-toggle="collapse">
          <i class="fa fa-cogs"></i>设置<i class="fa fa-angle-right"></i>
        </a>
          <!-- ul的in类名 控制列表展开和折叠 -->
        <ul id="menu-settings" class="collapse  <?php echo $isSet ? 'in': '' ?>">
          <li  class="<?php echo $page==='nav-menus' ? 'active':'' ?>"><a href="nav-menus.php">导航菜单</a></li>
          <li  class="<?php echo $page==='slides' ? 'active':'' ?>"><a href="slides.php">图片轮播</a></li>
          <li  class="<?php echo $page==='settings' ? 'active':'' ?>"><a href="settings.php">网站设置</a></li>
        </ul>
      </li>
    </ul>
  </div>