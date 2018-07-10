<?php 

    // 封装一个操作数据库的方法
    header('content-type:text/html;charset=utf-8');
    define('HOST','127.0.0.1');
    define('USERNAME','root');
    define('PSD','root');
    define('DBNAME','z_baixiu');

    function my_exec( $sql ){
        $link = @ mysqli_connect(HOST,USERNAME,PSD,DBNAME);
        if( !$link ){
            echo "数据库连接失败";
            return false;
        }

        if( !mysqli_query($link,$sql)){
            echo "数据操作失败";
            mysqli_close($link);
            return false;
        }
        mysqli_close($link);
        return true;
        
    }
    function my_query( $sql ){
        $link = @ mysqli_connect(HOST,USERNAME,PSD,DBNAME);
        // echo '<pre>';
        // print_r($link);
        // echo '</pre>';
        if( !$link ){
            echo "数据库连接失败";
            return false;
        }
       $res = mysqli_query( $link, $sql );
       if( !$res || mysqli_num_rows( $res ) === 0 ){
           echo "数据库查询失败";
           mysqli_close( $link );
           return false; 
       }
       while( $row = mysqli_fetch_assoc($res)){
           $data[] = $row; 
       }
       mysqli_close( $link );  
       return $data; //以二维数组形式返回数据
    }
    // $sql = "delete from posts where id=63 ";
    // my_exec($sql);
    // $sql = "select * from posts where id>60";
    // $result = my_query($sql);
    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';
    function isLogin(){
        if(!empty($_COOKIE['PHPSESSID'])){
            session_start();
            if(empty($_SESSION['user_id'])){
                // echo '用户已登录过!';
                header('location:./login.php');
                die();
            }
            
        }else {
            header('location:./login.php');
            die();
        }
    }

?>