<?php
header("Content-type:text/html;charset=UTF-8");
 date_default_timezone_set('PRC');

  @$user_name=$_COOKIE['user_name'];
  $file_name=$_POST['file_name'];
  if (isset($_COOKIE['user_name'])) {

}else {
	$ret = ["code" => 0,"msg" =>'δ��¼'];
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
    exit();
}

$path="../upload/user/html/".$user_name."/".$file_name.".txt";


deleteHtmlFile($path);

function deleteHtmlFile($path){
$a=array();
 
   if (file_exists($path)){
         $a['msg']="�ļ�����";
      if(!unlink($path))
      {
        $a['msg']=$file_name."�ļ�ɾ��ʧ��";   
       }else 
       {
       $a['msg']="�ļ�ɾ���ɹ�";
       }    

}else {
	$a['msg']="�ļ�������";

}
 echo json_encode($a,JSON_UNESCAPED_UNICODE);;
   
}





?>