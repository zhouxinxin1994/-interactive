<?php
header("Content-Type:text/html;charset=utf-8");
// ----------把传过的数据入库--------------
require_once('connection.php');
// print_r($_POST);//返回的是一个数组
//入库前要对所有的信息进行校验
$video_id=$_GET['video_id'];

$search1="select * from video where video_id='$video_id'";
$result1=mysqli_query($con,$search1);
$row1=mysqli_fetch_assoc($result1);
$user_id = $row1['user_id'];

$search2 = "select * from user where user_id=$user_id";
$result2=mysqli_query($con,$search2);
$row2=mysqli_fetch_assoc($result2);

$ret = [
    "code" => 1,
    "user_name" =>$row2["user_name"],
    "video_name"=>$row1["video_name"],
    "video_head"=>$row1["video_head"],
    "video_type"=>$row1["video_type"],
    "video_status"=>$row1["video_status"],
    "video_answer_json"=>$row1["video_answer_json"]
];
 echo json_encode($ret,JSON_UNESCAPED_UNICODE);
?>