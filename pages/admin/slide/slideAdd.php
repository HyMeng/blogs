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
        $info['image'] = $newName;
        move_uploaded_file( $ftp, '../../'.$newName );

        $info['text'] = $_POST['text'];
        $info['link']  = $_POST['link'];
        // echo '<pre>';
        // print_r($info);
        // echo '</pre>';
        $sql = "select value from options where id=10";
        $data = my_query( $sql )[0]['value'];
        $data = json_decode( $data, true);
        $data[] = $info;
        $jsonStr = json_encode($data);
        $sql = "update options set value = '$jsonStr' where id=10";
        
        my_exec($sql);
        
    }
?>