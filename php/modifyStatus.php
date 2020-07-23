<?php
header("Content-Type:text/html;charset=utf-8");
// ----------把传过的数据入库--------------
require_once('connection.php');
// print_r($_POST);//返回的是一个数组
//入库前要对所有的信息进行校验
$video_id=$_GET['video_id'];
$video_status=$_GET['video_status'];

$update_sql="update video SET video_status = '$video_status' WHERE video_id = '$video_id'";
$retval = mysqli_query( $con, $update_sql );
if(!$retval )
{
    die('无法更新数据: ' . mysqli_error($con));
}

$ret = [
    "code" => 1,
    "msg" =>' 数据更新成功！'

];
 echo json_encode($ret,JSON_UNESCAPED_UNICODE);
?>