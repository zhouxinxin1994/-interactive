
<?php
header("Content-Type:text/html;charset=utf-8");//判断是退出还是登录
$act=$_POST['act'];
require_once("connection.php");
if($act=='logout'){
   
    $ret = ["code" => 1,"msg" =>"退出成功"];
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
} else {
    $user_name=$_POST['user_name'];
    $user_password=$_POST['user_password'];
    if($user_name){
        $sql="select * from vp_test where user_name='{$user_name}' and user_password='{$user_password}'";
        $result=mysqli_query($con,$sql);
        if (!$result){
        printf("Error: %s\n", mysqli_error($con));
        exit();
        }
        if($user_password){
            if($act=='login'){
                if(mysqli_num_rows($result)==1){
                    $row=mysqli_fetch_assoc($result);
                    $_SESSION['user_name']=$row["user_name"];
                    $_SESSION['user_id']=$row["user_id"];
                    $_SESSION['isLogin']=1;
                    $ret = ["code" => 1,"user_name" =>$row["user_name"],"user_type"=>$row["user_type"],"user_id"=>$row["user_id"]];
                   
                    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
                    setcookie ( "user_name", $user_name, time () + 3600 * 24,"/");  
                    setcookie ( "user_password", $user_password, time () + 3600 * 24,"/");  
                }else{
                    $ret = ["code" => 0,"msg" =>"密码错误"];
                    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
                }
            }         
        }else{
            echo "<script>alert('请输入密码');</script>";        
        }
    }else{
        echo "<script>alert('请输入用户名');</script>";    

    }
}