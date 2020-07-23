<?php
header("Content-type:text/html;charset=UTF-8");
 date_default_timezone_set('PRC');
/**

 * PHP上传视频

 */
 $post=$_POST['state'];
 @$user_name=$_COOKIE['user_name'];
 @$project_name=$_POST['project_name'];


 if (isset($_COOKIE['user_name'])) {
 if ($post=="frist_upload_video") {

 if (isMobile()) {
    $a=array();
    $a['code']="2";
    $a['msg']="本页面不支持手机端，请转至PC端登录";
    $a['src']="index.html";
	echo json_encode($a,JSON_UNESCAPED_UNICODE);
    exit();
}else {
    $b=array();
    $b['code']="1";
    $b['msg']="登录成功";
    $b['src']="updata.html";
    $b['name']=$user_name;
    echo json_encode($b,JSON_UNESCAPED_UNICODE);
    //header('location:../updata.html');
}
}
  
 }else {
	


  $b=array();
    $c['code']="0";
    $c['msg']="未登录";
    $c['src']="login.html";

}



 if ($post=="100") {
 
 $files=array();

 $a=array();

 function my_scandir($dir)
{
    //定义一个数组
    
    //检测是否存在文件
    if (is_dir($dir)) {
        //打开目录
        if ($handle = opendir($dir)) {
            //返回当前文件的条目
            while (($file = readdir($handle)) !== false) {
                //去除特殊目录
                if ($file != "." && $file != "..") {
                    //判断子目录是否还存在子目录
                    if (is_dir($dir . "/" . $file)) {
                        //递归调用本函数，再次获取目录
                        // my_scandir($dir . "/" . $file);
                    } else {
                        //获取目录数组
                        
                         $files[]= $dir . "/" . $file;
               
                    }
                }
            }
            //关闭文件夹
            closedir($handle);
            //相对路径

            //返回文件夹数组
                     
            if (is_array($files)) {
              global $a;
              $i=1;
	          foreach($files as $value){ 
              $b='video'.(string)$i;
              $a[$b]['src']=rela_pos("../",$value);
              $a[$b]['name'] =basename($value);             
              $i=$i+1;

            }
}                 
        }
    }
   
}


function rela_pos($base, $path)          //绝对路径转相对
{
    $base = explode('/', trim($base,'/'));
    $path = explode('/', trim($path,'/'));
    $ln1 = count($base);
    $ln2 = count($path);
    if ($ln1 > $ln2) {
        $i = 0;
        foreach ($path as $k => $v) {
            if ($v == $base[$k]) {
                $i++;
            }else{
                break;
            }
        }
    } else {
        $i = 0;
        foreach ($base as $k1 => $v1) {
            if ($v1 == $path[$k1]) {
                $i++;
            }else{
                break;
            }
        }
    }
    array_splice($base, 0, $i);
    array_splice($path, 0, $i);
    //当前两个路径有相同的根目录
    $b_len=count($base)-1;
    $st='';
   for($j=0;$j<$b_len;$j++){
    $st.='../';
   }
    return $st.implode('/',$path);
}


    my_scandir("../upload/user/video/".$user_name."/".$project_name."/"); //电脑的文件路径即可
    echo json_encode($a,JSON_UNESCAPED_UNICODE);;

}

if ($post=="110") {

$path-"../upload/user/html/".$user_name."/".$project_name;
  
   function upHTML_file($html, $path,$imagesExt=['txt'])
   {

        if (!is_dir($path)){

            mkdir($path,0777,true);
        }

        // 生成唯一的文件名

        $fileName = md5(uniqid(microtime(true),true)).'.'.'txt';

        // 将文件名拼接到指定的目录下

        $destName = $path."/".$fileName;

        $myfile=fopen($destName,'w');
        fwrite($myfile,$html);
       fclose($myfile);

    }

    upHTML_file($uphtml);
  
 }



if ($post=="200") 
{
	$upfile = $_FILES['upfile'];
 $path = "../upload/user/video/".$user_name."/".$project_name;

function upload_file($files, $path,$imagesExt=['jpg','png','jpeg','gif','mp4'])
{
    // 判断错误号
    if ($files['error'] == 00) {
        
        $ext = strtolower(pathinfo($files['name'],PATHINFO_EXTENSION));
        // 判断文件类型
        if (!in_array($ext,$imagesExt)){

            
            return "非法文件类型";

        }

        // 判断是否存在上传到的目录

        if (!is_dir($path)){

            mkdir($path,0777,true);

        }

        // 生成唯一的文件名
        

        $fileName = md5(uniqid(microtime(true),true)).'.'.$ext;
       

        
        // 将文件名拼接到指定的目录下

        //$destName = $path."/".$fileName;

        $destName = $path."/".date("Ymdhms").$files['name'];

        // 进行文件移动 
        if (!move_uploaded_file($files['tmp_name'],$destName)){

            $json['msg'] = "文件上传失败！";
            return json_encode($json,JSON_UNESCAPED_UNICODE);;

        }
        
        $json['msg'] = "文件上传成功";
        $json['src'] = str_replace('../','',$destName);
        $json['name'] =  basename($destName);
        return json_encode($json,JSON_UNESCAPED_UNICODE);;

    } else {

        // 根据错误号返回提示信息

        switch ($files['error']) {

            case 1:

                echo "上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";

                break;

            case 2:

                echo "上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";

                break;

            case 3:

                echo "文件只有部分被上传";

                break;

            case 4:

                echo "没有文件被上传";

                break;

            case 6:
                echo "找不到临时文件夹";
                break;

            case 7:

                echo "系统错误";

                break;

        }

    }

}

echo upload_file($upfile,$path);

}


function isMobile()
{ 
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
    {
        return true;
    } 
    // 如果via信息含有wap则一定是移动设备
    if (isset ($_SERVER['HTTP_VIA']))
    { 
        // 找不到为flase,否则为true
        return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
    } 
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高
    if (isset ($_SERVER['HTTP_USER_AGENT']))
    {
        $clientkeywords = array ('nokia',
            'sony',
            'ericsson',
            'mot',
            'samsung',
            'htc',
            'sgh',
            'lg',
            'sharp',
            'sie-',
            'philips',
            'panasonic',
            'alcatel',
            'lenovo',
            'iphone',
            'ipod',
            'blackberry',
            'meizu',
            'android',
            'netfront',
            'symbian',
            'ucweb',
            'windowsce',
            'palm',
            'operamini',
            'operamobi',
            'openwave',
            'nexusone',
            'cldc',
            'midp',
            'wap',
            'mobile'
            ); 
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
        {
            return true;
        } 
    } 
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT']))
    { 
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
        {
            return true;
        } 
    } 
    return false;
} 





?>