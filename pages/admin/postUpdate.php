<?php 
    header('content-type:text/html;charset=utf-8');
    ini_set('date.timezone','Asia/Shanghai');
    include_once "./fn.php";
    $id = $_POST['id'];
    $content = $_POST['content'];
    $title = $_POST['title'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    $feature = "";
    $file = $_FILES['feature'];
    // echo '<pre>';
    // print_r($file);
    // echo '</pre>';
    $time=time();//获取时间戳
    $date = date('YmdHis',$time); //格式化时间戳
    if($file['error'] === 0){
        $ftp = $file['tmp_name'];
        $ext = strrchr($file['name'], '.');
        $newName = './uploads/' . $date.rand(1000,9999).$ext;
        move_uploaded_file($ftp , '../'. $newName);
        $feature = $newName;
    }
    //根据id 将新获取的数据更新到数据库中
    //如果上传了图片，用新图片覆盖旧图片，如果没有上传，继续保留旧图片
    if( empty($feature) ){
        $sql = " update posts set title='$title', content='$content' ,category_id =$category, created='$created',slug='$slug',
        status='$status' where id =$id";
    }else {
        $sql = " update posts set title='$title', content='$content' ,category_id =$category, created='$created',slug='$slug',
        status='$status',feature='$feature' where id =$id ";
    }
    // echo $sql;
    //执行
    my_exec($sql);
    // if (empty($feature)) {
    //     //保留原图片
    //     $sql = "update posts set title = '$title' , content = '$content', slug = '$slug', category_id = $category, created = '$created', status = '$status' where id = $id ";
    // } else {
    //     //用新图片覆盖旧图片 
    //     $sql = "update posts set title = '$title' , content = '$content', slug = '$slug', category_id = $category, created = '$created', status = '$status', feature = '$feature' where id = $id ";
    // }
    // echo $sql;
    // //执行
    // my_exec($sql);








    // $data = my_query($sql)[0];

    // echo json_encode( $data );

    

?>