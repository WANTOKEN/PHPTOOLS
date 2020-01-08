<?php
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class TestMailer
{
    private $userEmail = 'ztkvip@163.com'; //发送者邮箱
    private $userName = 'ztkvip';          //发送者邮箱名
    private $userPass = 'asd123';          //发送者邮箱密令
    private $smtpHost = 'smtp.163.com';    //服务主机
    private $smtpHostPort = 465;           //端口
    private $mail = null;

    public function __construct()
    {
        //服务器配置
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = "UTF-8"; //设定邮件编码
        $this->mail->SMTPDebug = 1;                        // 调试模式输出
        $this->mail->isSMTP();                             // 使用SMTP
        $this->mail->Host = $this->smtpHost;                // SMTP服务器
        $this->mail->SMTPAuth = true;                      // 允许 SMTP 认证
        $this->mail->Username = $this->userName;            // SMTP 用户名  即邮箱的用户名
        $this->mail->Password = $this->userPass;             // SMTP 密码  部分邮箱是授权码(例如163邮箱)
        $this->mail->SMTPSecure = 'ssl';                    // 允许 TLS 或者ssl协议
        $this->mail->Port = $this->smtpHostPort;             // 服务器端口 25 或者465 具体要看邮箱服务器支持
    }

    public function sendEmail($adderss,$subject,$body)
    {
        try {
            $this->mail->setFrom($this->userEmail, $this->userName);  //发件人
            foreach ($adderss as $to){
                $this->mail->addAddress($to['email'], $to['name']);  // 收件人
            }
            //$mail->addAddress('ellen@example.com');  // 可添加多个收件人
            $this->mail->addReplyTo($this->userEmail, $this->userName); //回复的时候回复给哪个邮箱 建议和发件人一致
            //$mail->addCC('cc@example.com');                    //抄送
            //$mail->addBCC('bcc@example.com');                    //密送

            //发送附件
            // $mail->addAttachment('../xy.zip');         // 添加附件
            // $mail->addAttachment('../thumb-1.jpg', 'new.jpg');    // 发送附件并且重命名

            //Content
            $this->mail->isHTML(true);                                  // 是否以HTML文档格式发送  发送后客户端可直接显示对应HTML内容
            $this->mail->Subject = $subject;
            $this->mail->Body = $body;
            $this->mail->AltBody = '如果邮件客户端不支持HTML则显示此内容';

            $this->mail->send();
            echo '邮件发送成功';
        } catch (Exception $e) {
            echo '邮件发送失败: ', $this->mail->ErrorInfo;
        }
    }
}
$mail = new TestMailer();
$address=[
    ['email'=>'1136717125@qq.com','name'=>'ZTK'], //发送到用户
    ['email'=>'xxxx@qq.com','name'=>'ZTK']
];
$subject = '这里是邮件标题' . time();
$body = '<h1>这里是邮件内容</h1>' . date('Y-m-d H:i:s');
$mail->sendEmail($address,$subject,$body);