<?php

header("Content-type:text/html;charset=UTF-8");
 date_default_timezone_set('PRC');


 @$user_name=$_COOKIE['user_name'];
 @$project=$_POST['project_name'];



 createvideo($user_name,$project);

 $value=array();
function createvideo($user_name,$project)
{

 
    $createpath = '../upload/user/video/'.$user_name."/".$project;

    $_createpath = iconv('utf-8', 'gb2312', $createpath);

    if (file_exists($_createpath) == false)

    {

        //����Ƿ��и��ļ��У����û�оʹ��������������Ȩ��

        if (mkdir($_createpath, 0700, true)) {

            $value['file'] ='�ļ��д����ɹ�';

            $value['success']='success';

        } else {

            $value['file'] ='�ļ��д���ʧ��';

            $value['fail']='fail';

        }

    }
  else

    {
        $value['file'] ='�ļ����Ѵ���';
        $value['fail']='fail';
    }

    
    
     
}

createhtml($user_name,$project);

function createhtml($user_name,$project){

 $createpath = '../upload/user/html/'.$user_name;

  $_createpath = iconv('utf-8', 'gb2312', $createpath);

    //����Ƿ��и��ļ��У����û�оʹ��������������Ȩ��

       if (file_exists($_createpath) == false)

    {

        //����Ƿ��и��ļ��У����û�оʹ��������������Ȩ��

        if (mkdir($_createpath, 0700, true)) {

            $value['file'] ='�ļ��д����ɹ�';

            $value['success']='success';

        } else {

            $value['file'] ='�ļ��д���ʧ��';

            $value['fail']='fail';

        }

    }
  else

    {
        $value['file'] ='�ļ����Ѵ���';
        $value['fail']='fail';
    }


 $createpath = '../upload/user/html/'.$user_name."/".$project;
 $modeltxt='../upload/user/model.txt';

$model=fopen($modeltxt,"r");
$file = fopen($createpath.".txt","w");
fwrite($file,iconv('gb2312', 'utf-8', fread($model,filesize($modeltxt))));
fclose($file);



}








echo json_encode($value,JSON_UNESCAPED_UNICODE);;

   


?>