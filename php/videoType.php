<?php
header("Content-Type:text/html;charset=utf-8");
// ----------把传过的数据入库--------------
require_once('connection.php');
// print_r($_POST);//返回的是一个数组
//入库前要对所有的信息进行校验

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $sql="select * from video where user_id='$user_id' and video_status = 2";
} else {
    $video_type=$_GET['video_type'];
    if($video_type == '全部') {
        $sql="select * from video where video_status = 2";//把所有数据按照时间升序排列
    } else {
        $sql="select * from video where video_type='$video_type'and video_status = 2";//把所有数据按照时间升序排列
    }
}


$query=mysqli_query($con,$sql);
    if($query&&mysqli_num_rows($query)){//判断是否读出数据和是否条数等于0
        while($row=mysqli_fetch_assoc($query)){
            $data[]=$row;//每次循环会给data添加下标和值
        }
    }else{
        $data=array();
    }
echo json_encode($data,JSON_UNESCAPED_UNICODE);
?>