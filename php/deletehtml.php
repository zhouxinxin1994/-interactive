<?php
header("Content-type:text/html;charset=UTF-8");
 date_default_timezone_set('PRC');

  @$user_name=$_COOKIE['user_name'];
  $file_name=$_POST['file_name'];
  if (isset($_COOKIE['user_name'])) {

}else {
	$ret = ["code" => 0,"msg" =>'未登录'];
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
    exit();
}

$path="../upload/user/html/".$user_name."/".$file_name.".txt";


deleteHtmlFile($path);

function deleteHtmlFile($path){
$a=array();
 
   if (file_exists($path)){
         $a['msg']="文件存在";
      if(!unlink($path))
      {
        $a['msg']=$file_name."文件删除失败";   
       }else 
       {
       $a['msg']="文件删除成功";
       }    

}else {
	$a['msg']="文件不存在";

}
 echo json_encode($a,JSON_UNESCAPED_UNICODE);;
   
}





?>