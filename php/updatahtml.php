<?php

 $user_name=$_COOKIE['user_name'];
 $uphtml=$_POST['upHTML'];
 $project_name=$_POST['project_name'];
 $post=$_POST['state'];

  
if ($post=="110") {

 $path = "../upload/user/html/".$user_name;


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

      
        $a=array();
        $a['project_name']=$project_name;
      echo json_encode($a,JSON_UNESCAPED_UNICODE);
    }


    
    upHTML_file($uphtml,$path,$project_name);
    



  
 }

 ?>