<?php
header("Content-Type:text/html;charset=utf-8");
require_once('connection.php');
    
$video_id=$_GET['video_id'];
$deletesql="delete from video where video_id='$video_id'";

if(mysqli_query($con,$deletesql)){
    $ret = ["code" => 1,"msg" =>"视频删除成功"];
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
        
}else{
    echo mysqli_error($con);
    echo "<script> alert('视频删除失败');</script>";        
}
?>
    