<?php
header('Content-type:text/html;charset=UTF-8');
date_default_timezone_set('PRC');

require_once("PHPMailer-master/language/phpmailer.lang-zh_cn.php");
require_once("PHPMailer-master/src/PHPMailer.php");
require_once("PHPMailer-master/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; 


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
$mail->addAddress('setting@gmail.com');
// ��Ӷ���ռ��� ���ε��÷�������
//$mail->addAddress('87654321@163.com');
// ��Ӹ��ʼ�������
$title=iconv('GBK','UTF-8','�ʼ�����');
$mail->Subject =$title;
// ����ʼ�����
$mail->Body = '<h1>Hello World</h1>';
// Ϊ���ʼ���Ӹ���
//$mail->addAttachment('./example.pdf');
// �����ʼ� ����״̬
$status = $mail->send();




?>