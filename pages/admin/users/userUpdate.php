<?php
    header('content-type:text/html;charset=utf-8');
    include_once "../fn.php";
    ini_set('date.timezone','Asia/Shanghai');
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    // echo '<pre>';
    // print_r($_FILES);
    // echo '</pre>';
    $id = $_POST['id'];
    $email = $_POST['email'];
    $slug = $_POST['slug'];
    $nickname = $_POST['nickname'];
    $psd = $_POST['password'];
    $file = $_FILES['image'];
    $image = '';
    if( $file['error'] === 0) {
        $ftp = $file['tmp_name'];
        $ext = strrchr($file['name'],'.');
        $time = time();
        $newName = './uploads/'. date('YmdHis',$time).rand(1000,9999).$ext;
        echo $newName;
        $image = $newName;
        move_uploaded_file( $ftp, '../../'.$newName );
        // echo '<pre>';
        // print_r($info);
        // echo '</pre>';  
    }
    if(empty($image)){
        $sql = "update users set email='$email',slug='$slug',nickname='$nickname',password='$psd' where id = $id";
    }else{
        $sql = "update users set avatar='$image',email='$email',slug='$slug',nickname='$nickname',password='$psd' where id = $id";
        echo $sql;
    }
   
    // echo $sql;
    my_exec($sql);
?>