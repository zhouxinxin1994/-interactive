<?php
header("Content-type:text/html;charset=UTF-8");
if (!isset($_COOKIE['username'])) {
    $a['msg']=iconv("GB2312","UTF-8",'δ��¼');
    
    exit( json_encode($a,JSON_UNESCAPED_UNICODE));;
    
}
    //Ч���û���½ƾ֤
if (isset($_COOKIE['auth'])) {
    $auth = $_COOKIE['auth'];
    $resArr = explode(':', $auth);
    $userid = end($resArr);
    $con = mysqli_connect('localhost', 'root', 'zjxhdsp123!');
    if ($con) {
        mysqli_set_charset($con, 'utf8');
        mysqli_select_db($con, 'test') or die("select database failed");
        $sql = "select id,username,password from user where id='{$userid}'";
        $res = mysqli_query($con, $sql);
        if (mysqli_num_rows($res) == 1) {
            $row = mysqli_fetch_assoc($res);
            $username = $row['username'];
            $password = $row['password'];
            $salt = 'zhouzzz';
            $authStr = md5($username . $password . $salt);
            if ($authStr != $resArr[0]) {
                exit("<script>
                alert('�����ȵ�½�Ժ����');
                location.href='login.php';
                </script>");
            } else {
                
            }
        }
    } else {
        die('Connect Error');
    }
}
?>

