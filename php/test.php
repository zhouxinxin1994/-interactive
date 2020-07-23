<?php
 header("Content-type:text/html;charset=gb1232");

@$user_name=$_COOKIE['user_name'];
@$project_name=$_POST['project_name'];
@$video_name=$_POST['video_name'];


function videoImg($user_name,$project_name,$video_name){
$from = "..\\release\\user\\".$user_name."\\".$project_name."\\video\\";
$to = "..\\release\\user\\".$user_name."\\".$project_name."\\img.png";
$str = "ffmpeg -i ".$from." -y -f mjpeg -ss 3 -t 1 -s 740x500 ".$to;
echo shell_exec($str);
echo $str;
}






?>