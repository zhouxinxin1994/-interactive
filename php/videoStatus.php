<?php
header("Content-Type:text/html;charset=utf-8");
// ----------把传过的数据入库--------------
require_once('connection.php');
// print_r($_POST);//返回的是一个数组
//入库前要对所有的信息进行校验
$video_status = $_GET['video_status'];

$sql="select * from video where video_status='$video_status'";
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