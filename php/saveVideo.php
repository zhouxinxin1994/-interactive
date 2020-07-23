<?php
header("Content-Type:text/html;charset=utf-8");
// ----------把传过的数据入库--------------
require_once('connection.php');
// print_r($_POST);//返回的是一个数组
$user_id=$_POST['user_id'];
$video_name=$_POST['video_name'];
$video_head=$_POST['video_head'];
$video_type=$_POST['video_type'];
$video_answer_json=$_POST['video_answer_json'];
$video_status=$_POST['video_status'];

$insert="insert into video(user_id,video_name,video_head,video_type,video_answer_json,video_status) values('$user_id','$video_name','$video_head','$video_type','$video_answer_json','$video_status')";
if(mysqli_query($con,$insert)){
    $video_id = mysqli_insert_id($con);
    $ret = ["code" => 1,"msg" =>'success',"video_id" => $video_id];
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
}else{
    echo mysqli_error($con);      
}
?>