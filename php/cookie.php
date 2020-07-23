<?php

@$act=$_POST['act'];



if (isset($_COOKIE['user_name'])) {
    $ret=["code"=>1,"user_name"=>$_COOKIE['user_name'],"msg"=>'登录'];
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
}else {
	$ret = ["code" => 0,"msg" =>'未登录'];
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
}




?>