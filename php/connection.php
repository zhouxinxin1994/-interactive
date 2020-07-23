<?php
// ---------对数据库的初始化-------------
    require_once('config.php');//把配置文件引入
    //连库
    // print_r([HOST, USERNAME, PASSWORD]);
    
    if($con=mysqli_connect(HOST, USERNAME, PASSWORD,'interactive_video')){
        echo "";
    }else{
        //echo mysqli_error($con);
	echo mysqli_connect_error($con);
        echo "连接失败";                
    }
    //选库
    //if(mysqli_select_db($con,'check_in')){
      //  echo "选库成功";
    //}else{
      //  echo mysqli_error($con);        
        //echo "选库失败";        
    //};
    //字符集
    mysqli_query($con,'set names utf8');
?>
