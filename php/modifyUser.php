<?php
header("Content-Type:text/html;charset=utf-8");
// ----------把传过的数据入库--------------
//修改数据
require_once('connection.php');
// print_r($_POST);//返回的是一个数组
//入库前要对所有的信息进行校验
$user_id=$_POST['user_id'];
$user_name=$_POST['user_name'];
$user_password=$_POST['user_password'];

if(!$user_password) {
    $update_sql="update user SET user_name = '$user_name' WHERE user_id = '$user_id'";
} else {
    $update_sql="update user SET user_name = '$user_name', user_password = '$user_password' WHERE user_id = '$user_id'";
}
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