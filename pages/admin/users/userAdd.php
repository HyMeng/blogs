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

    $file = $_FILES['image'];
    if( $file['error'] === 0) {
        $ftp = $file['tmp_name'];
        $ext = strrchr($file['name'],'.');
        $time = time();
        $newName = './uploads/'. date('YmdHis',$time).rand(1000,9999).$ext;
        echo $newName;
        $image = $newName;
        move_uploaded_file( $ftp, '../../'.$newName );
        $email = $_POST['email'];
        $slug = $_POST['slug'];
        $nickname = $_POST['nickname'];
        $psd = $_POST['password'];
       
        // echo '<pre>';
        // print_r($info);
        // echo '</pre>';
        $sql = "insert into users (avatar,email,slug,nickname,password) values ('$image','$email','$slug','$nickname','$psd') ";
        // echo $sql;
        my_exec($sql);
        
    }
    // $sql = "select value from options where id=10";
    // $data = my_query( $sql )[0]['value'];
    // echo $data;
?>