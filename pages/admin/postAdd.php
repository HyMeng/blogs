<?php
    include_once './fn.php';
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>';
    echo '<pre>';
    print_r($_FILES);
    echo '</pre>';
    $title = $_POST['title'];
    $content = $_POST['content'];
    $slug = $_POST['slug'];
    $category = $_POST['category'];
    $created = $_POST['created'];
    $status = $_POST['status'];
    $file = $_FILES['feature'];
    $feature = '';
    session_start();
    $user_id = $_SESSION['user_id'];
    if($file['error'] === 0){
        $ftp = $file['tmp_name'];
        $name = strrchr($file['name'],'.');
        echo $name;
        $newName = './uploads/'.time().rand(10000,99999).$name;
        move_uploaded_file($ftp,'../'.$newName);
        $feature = $newName;
    }
    $sql = "insert into posts (slug, title, feature, created, content, status, user_id, category_id) 
    values ('$slug', '$title', '$feature', '$created', '$content', '$status', $user_id, $category)";

    my_exec($sql);
    
    //跳转到文章页 
    header('location:./posts.php');
 
?>