<?php
header("Content-Type:text/html;charset=utf-8");
// ----------�Ѵ������������--------------
require_once('connection.php');
require_once("PHPMailer-master/language/phpmailer.lang-zh_cn.php");
require_once("PHPMailer-master/src/PHPMailer.php");
require_once("PHPMailer-master/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; 



function sendCodeMail($user_email,$codemail)
{
// ʵ����PHPMailer������
$mail = new PHPMailer();
// �Ƿ�����smtp��debug���е��� �����������鿪�� ��������ע�͵����� Ĭ�Ϲر�debug����ģʽ
$mail->SMTPDebug = 1;
// ʹ��smtp��Ȩ��ʽ�����ʼ�
$mail->isSMTP();
// smtp��Ҫ��Ȩ ���������true
$mail->SMTPAuth = true;
// ����qq��������ķ�������ַ
$mail->Host = 'smtp.qq.com';
// ����ʹ��ssl���ܷ�ʽ��¼��Ȩ
$mail->SMTPSecure = 'ssl';
// ����ssl����smtp��������Զ�̷������˿ں�
$mail->Port = 465;
// ���÷��͵��ʼ��ı���
$mail->CharSet = 'UTF-8';
// ���÷������ǳ� ��ʾ���ռ����ʼ��ķ����������ַǰ�ķ���������
$formname=iconv('GBK','UTF-8','ϵͳ�ظ�');
$mail->FromName = $formname;
// smtp��¼���˺� QQ���伴��
$mail->Username = 'demo@qq.com';
// smtp��¼������ ʹ�����ɵ���Ȩ��
$mail->Password = 'demo';
// ���÷����������ַ ͬ��¼�˺�
$mail->From = 'demo@qq.com';
// �ʼ������Ƿ�Ϊhtml���� ע��˴���һ������
$mail->isHTML(true);
// �����ռ��������ַ
$mail->addAddress('demo@gmail.com');
//$mail->addAddress($user_email);
// ��Ӷ���ռ��� ���ε��÷�������
//$mail->addAddress('87654321@163.com');
// ��Ӹ��ʼ�������
$title=iconv('GBK','UTF-8','������֤��');
$mail->Subject =$title;
// ����ʼ�����
$mail->Body = "<h1>��ӭע�ụ����Ƶ����֤�룺".$codemail."</h1>";
// Ϊ���ʼ���Ӹ���
//$mail->addAttachment('./example.pdf');
// �����ʼ� ����״̬
$status = $mail->send();
  
}
$code=mailCode();

$insert="insert into active_code(active_code,data,is_active) values('$code','now()','0')";

function mailCode(){
$pool='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';//����һ����֤��أ���֤�������м����ַ����
$word_length=6;//��֤�볤��
  $code = '';//��֤��
        for ($i = 0, $mt_rand_max = strlen($pool) - 1; $i < $word_length; $i++)
        {
            $code .= $pool[mt_rand(0, $mt_rand_max)];
        }

return $code;
}


if(mysqli_query($con,$insert)){
    
    $msg['state'] = ["code" => 1,"msg" =>'success'];
    echo json_encode($ret,JSON_UNESCAPED_UNICODE);
}else{
    echo mysqli_error($con);      
}



?>