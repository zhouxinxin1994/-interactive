<?php
//header("Content-type:text/html;charset=UTF-8");
define('UTF32_BIG_ENDIAN_BOM', chr(0x00) . chr(0x00) . chr(0xFE) . chr(0xFF));
define('UTF32_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE) . chr(0x00) . chr(0x00));
define('UTF16_BIG_ENDIAN_BOM', chr(0xFE) . chr(0xFF));
define('UTF16_LITTLE_ENDIAN_BOM', chr(0xFF) . chr(0xFE));
define('UTF8_BOM', chr(0xEF) . chr(0xBB) . chr(0xBF));
$first2 = substr($text, 0, 2);
$first3 = substr($text, 0, 3);
$first4 = substr($text, 0, 3);
$encodType = "";
if (UTF8_BOM == $first3) {
    $encodType = 'UTF-8 BOM';
} else if (UTF32_BIG_ENDIAN_BOM == $first4) {
    $encodType = 'UTF-32BE';
} else if (UTF32_LITTLE_ENDIAN_BOM == $first4) {
    $encodType = 'UTF-32LE';
} else if (UTF16_BIG_ENDIAN_BOM == $first2) {
    $encodType = 'UTF-16BE';
} else if (UTF16_LITTLE_ENDIAN_BOM == $first2) {
    $encodType = 'UTF-16LE';
}

//������ж���Ҫ�����ж�ANSI����ġ�
if ('' == $encodType) {
    //��Ĭ�ϴ�����txt�ı�-ANSI�����
    $content = iconv("GBK", "UTF-8", $text);
} else if ('UTF-8 BOM' == $encodType) {
    //��������UTF-8����ת��
    $content = $text;
} else {
    //�����ĸ�ʽ��ת��ΪUTF-8�Ϳ�����
    $content = iconv($encodType, "UTF-8", $text);
}


require_once('config.php');



$post=$_POST['state'];
@$user_name=$_COOKIE['user_name'];
@$video_name=$_COOKIE['video_name'];
@$project_name=$_POST['project_name'];
@$video_id=$_POST['video_id'];
@$src=$_POST['src'];


geturlvideo($video_id);


function geturlvideo($video_id){

//$video_name=iconv('GBK',"UTF-8",$video_name);

$sql= "SELECT video_id,video_name,video_url,video_img,user_name,video_main_url FROM vp_id WHERE video_id='$video_id'";

if($con=mysqli_connect(HOST, USERNAME, PASSWORD,'interactive_video')){

   mysqli_query($con,'set names utf8');
   $result = mysqli_query($con, $sql);

   //iconv('GBK',"UTF-8",$result);
       if (!$result) {
       printf("Error: %s\n", mysqli_error($con));
       exit();
       }
           if (mysqli_num_rows($result) > 0) {

           $row=mysqli_fetch_assoc($result);
           $path=$row["video_url"];
           $str=$path;//�������ļ����ݶ��뵽һ���ַ�����

           $str= str_replace("\r\n","<br/>",$str);

          echo $str; 

            }else {
             	echo "none";
            }

   }else{
 
	echo mysqli_connect_error($con);
        echo "����ʧ��";       
        exit();
    }
    //mysqli_query($con,'set names utf8');
   
}
   



?>