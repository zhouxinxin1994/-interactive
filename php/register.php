<?php

header("Content-Type:text/html;charset=utf-8");
// ----------把传过的数据入库--------------
require_once('connection.php');

// print_r($_POST);//返回的是一个数组
//入库前要对所有的信息进行校验




if(!(isset($_POST['user_name'])&&(!empty($_POST['user_name'])))){//判断是否存在该内容和是否为空
    echo "<script>alert('请输入昵称');</script>";
}
if(!(isset($_POST['user_email'])&&(!empty($_POST['user_email'])))){//判断是否存在该内容和是否为空
    echo "<script>alert('请输入正确的邮箱地址');</script>";
}
if(!(isset($_POST['user_password'])&&(!empty($_POST['user_password'])))){//判断是否存在该内容和是否为空
    echo "<script>alert('请输入密码');</script>";
}


$user_name=$_POST['user_name'];
$user_email=$_POST['user_email'];
$user_password=$_POST['user_password'];
$user_phone=$_POST['user_phone'];

global $msg;
$msg=array();







$search = "select `user_name` from vp_test where user_name='$user_name'";
$res_name=mysqli_query($con,$search);
if (!$res_name) {
    printf("Error: %s\n", mysqli_error($conn));
    echo "1";
    exit();
}
 // echo "4";
if(mysqli_num_rows($res_name)>0){
    global $msg;    
    $msg['state'] = ["code" => 0,"msg" =>'用户名已被注册'];
    echo  json_encode($msg,JSON_UNESCAPED_UNICODE);
    return;
}

$email_search = "select `user_email` from vp_test where user_email='$user_email'";
$res_email=mysqli_query($con,$email_search);
if (!$res_email) {
    printf("Error: %s\n", mysqli_error($conn));
     echo "2";
    exit();
}

if(mysqli_num_rows($res_email)>0){
 global $msg;
    $msg['state'] = ["code" => 0,"msg" =>'邮箱已被注册'];
     echo  json_encode($msg,JSON_UNESCAPED_UNICODE);
    return;
}

$phone_search="select `user_phone` from vp_test where user_phone='$user_phone'";
$res_phone=mysqli_query($con,$phone_search);
if (!$res_phone) {
    printf("Error: %s\n", mysqli_error($conn));
     echo "3";
    exit();
}
if (mysqli_num_rows($res_phone)>0) {
 global $msg;
	$msg['state'] = ["code" => 0,"msg" =>'手机已被注册'];
      echo  json_encode($msg,JSON_UNESCAPED_UNICODE);
    return;
    }

$insert="insert into vp_test(user_name,user_email,user_password,user_phone) values('$user_name','$user_email','$user_password','$user_phone')";
if(mysqli_query($con,$insert)){
 global $msg;
    $msg['state'] = ["code" => 1,"msg" =>'success'];
}else{
    echo mysqli_error($con);      
}



function spamcheck($field)
{
    // filter_var() 过滤 e-mail
    // 使用 FILTER_SANITIZE_EMAIL
    $field=filter_var($field, FILTER_SANITIZE_EMAIL);

    //filter_var() 过滤 e-mail
    // 使用 FILTER_VALIDATE_EMAIL
    if(filter_var($field, FILTER_VALIDATE_EMAIL))
    {
        return TRUE;
    }
    else
    {
        return FALSE;
    }
}


 echo json_encode($msg,JSON_UNESCAPED_UNICODE);
 

?>