<?php
header('Content-type:text/html;charset=UTF-8');
date_default_timezone_set('PRC');

require_once("connection.php");
@$user_name=$_COOKIE['user_name'];
@$html_txt=$_POST['html'];
@$video_name=$_POST['video_name'];
@$project_name=$_POST['project_name'];
@$src=$_POST['src'];
global $a;
 $a=array();
 
  if(isset($_COOKIE['user_name'])){

}else{
	$ret = ['code' => 0,'msg' =>'未登录'];
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
    exit();
}

$old_video_path='../upload/user/video/'.$user_name.'/'.$project_name;
$new_video_path='../release/user/'.$user_name.'/'.$project_name.'/video';
$old_html_path='../upload/user/html/'.$user_name.'/'.$project_name.'.txt';
$new_html_path='../release/user/'.$user_name.'/'.$project_name.'/html';
$video_img_path='../release/user/'.$user_name.'/'.$project_name.'/img.png';
$html_txt_path='../release/user/'.$user_name.'/'.$project_name.'/html/'.$project_name.'.txt';

copydir($old_video_path,$new_video_path);
upHTML_file($html_txt,$new_html_path,$project_name);
deldir($old_video_path);
deltxt($old_html_path);

function copydir($source, $dest)
{
    if (!file_exists($dest)) {
    mkdir($dest,0777,true);
    }
    $handle = opendir($source);
    while (($item = readdir($handle)) !== false) {
        if ($item =='.'|| $item == '..') continue;
        $_source = $source . '/' . $item;
        $_dest = $dest.'/'.$item;
        if (is_file($_source)) copy($_source, $_dest);
        if (is_dir($_source)) copydir($_source, $_dest);
    }
    closedir($handle);
}

function upHTML_file($html, $path,$project_name ,$imagesExt=['txt'])
   {
      
     
        if (!is_dir($path)){

            mkdir($path,0777,true);
        }

        // 生成唯一的文件名

        //$fileName = md5(uniqid(microtime(true),true)).'.'.'txt';

        $fileName=$project_name.'.'.'txt';
        // 将文件名拼接到指定的目录下

        $destName = $path."/".$fileName;

        $myfile=fopen($destName,'w');
        fwrite($myfile,$html);
       fclose($myfile);
       global $a;
       $a['project_name']=$project_name;
    }

  function deldir($dir) {
   //先删除目录下的文件：
   $dh=opendir($dir);
   while ($file=readdir($dh)) {
      if($file!="." && $file!="..") {
         $fullpath=$dir."/".$file;
         if(!is_dir($fullpath)) {
            unlink($fullpath);
         } else {
            deldir($fullpath);
         }
      }
   }
 
   closedir($dh);
   //删除当前文件夹：
   if(rmdir($dir)) {
      //return true;
   } else {
     // return false;
   }


   function deltxt($path){
       unlink($path);
     
   }
}


function videoImg($user_name,$project_name,$video_name){
$from = "../release/user/".$user_name."/".$project_name."/video/".$video_name;
$to = "../release/user/".$user_name."/".$project_name."/img.png";
$str = "ffmpeg -i ".$from." -y -f mjpeg -ss 3 -t 1 -s 740x500 ".$to;
echo shell_exec($str);
}

videoImg($user_name,$project_name,$video_name);


$insert="insert into vp_id(video_name,video_type,video_url,user_name,video_view,video_img) values('$project_name','测试视频','$html_txt','$user_name','0','$video_img_path')";
if(mysqli_query($con,$insert)){
    $ret = ["code" => 1,"msg" =>'success'];
    global $a;
    $a['sql']=$ret;
   
}else{
    echo mysqli_error($con);      
}

 echo json_encode($a,JSON_UNESCAPED_UNICODE);


?>