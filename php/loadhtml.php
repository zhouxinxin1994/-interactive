<?php


 $post=$_POST['state'];
 @$src=$_POST['src'];
 $txt_src=$_POST['txt_src'];
 $user_name=$_COOKIE['user_name'];


if ($post=="130") {

     loadhtmltext($src);

}

if ($post=="140") {
	
    
    gethtmlList();
}



function gethtmlList(){

$file_path  = "../upload/user/html/".$_COOKIE['user_name'];

if(!is_dir($file_path)){
    mkdir(iconv("GBK","UTF-8" , $file_path),0777,true);
}    
 $txt_html=array();
 $i=0;
foreach(glob($file_path.'/*.txt') as $filename)
{
  $encode = mb_detect_encoding($filename, array("ASCII",'UTF-8',"GB2312","GBK",'BIG5')); 
  $filename = mb_convert_encoding($filename, 'UTF-8', $encode);
  $b=(string)$i;
  $filename=str_replace(strrchr($filename, "."),"",$filename); 
  $txt_html[$b]['name']= get_basename($filename);    
  $txt_html[$b]['src']=$filename;
 $i=$i+1;
}
 echo json_encode($txt_html,JSON_UNESCAPED_UNICODE);
}

function loadhtmltext($file_path)
{
$file_path=$file_path.".txt";
if(file_exists($file_path)){

$str= file_get_contents($file_path);//将整个文件内容读入到一个字符串中

$str= str_replace("\r\n","<br/>",$str);

echo $str;

   }
}

function get_basename($filename){  
     return preg_replace('/^.+[\\\\\\/]/', '', $filename);  
     }
?>