<?php
header('Content-type:text/html;charset=UTF-8');
date_default_timezone_set('PRC');

require_once("connection.php");
@$user_name=$_COOKIE['user_name'];
@$html_txt=$_POST['html'];
@$video_name=$_POST['video_name'];
@$project_name=$_POST['project_name'];
@$src=$_POST['src'];


function GetVideoList(){

$sql= "SELECT video_id,video_name,video_url,video_img,user_name,video_main_url FROM vp_id ORDER BY video_id";

if($con=mysqli_connect(HOST, USERNAME, PASSWORD,'interactive_video')){

   mysqli_query($con,'set names utf8');
   $result = mysqli_query($con, $sql);

   //iconv('GBK',"UTF-8",$result);
       if (!$result) {
       printf("Error: %s\n", mysqli_error($con));
       exit();
       }
           if (mysqli_num_rows($result) > 0) {
          
          $row=array();
          while($row[]=mysqli_fetch_array($result,MYSQLI_ASSOC)){
          
		  }
          


           //$row=mysqli_fetch_assoc($result);
           $path=$row;

         echo json_encode($path,JSON_UNESCAPED_UNICODE);

            }else {
             	echo "none";
            }

   }else{
 
	echo mysqli_connect_error($con);
        echo "Α¬½ΣΚ§°ά";       
        exit();
    }
    //mysqli_query($con,'set names utf8');
   


}

GetVideoList();



?>