<?php
//Класс отвечающий за содержимое сообщения, а также его оправку по email

namespace Services;

use PHPMailer\PHPMailer\PHPMailer;

class EmailSender
{
    private $senderOptions;

    public function __construct()
    {
        $this->senderOptions = (require rootPath() . '/src/sendMailConfig.php')['config'];
    }
    public function sender(array $sentData)
    {
        //var_dump($sentData);
        require'../vendor/autoload.php';

        $button = true;
        $mail = new PHPMailer(true);

        $mail->From = $this->senderOptions['sender']['email'];
        $mail->FromName = "TEST";

        $mail->addAddress($this->senderOptions['receivers']['email'], $this->senderOptions['receivers']['name']);

        $mail->addReplyTo($this->senderOptions['sender']['email'], $this->senderOptions['sender']['name']);

        $mail->isHTML(true);

        $mail->Subject = "Student Form Registration";


        ob_start();
        require (rootPath()."/templates/mail/message.php");
        $body = ob_get_contents();
        ob_end_clean();
        $mail->Body = $body;
        $mail->AltBody = "This is the plain text version of the email content";

        $file = [
            'image'=>[
                'face_img' => $sentData['face_img'],
                'passport_img' => $sentData['passport_img'],
                'code_img' => $sentData['code_img'],
            ]
        ];

            foreach ($file['image'] as $key )
            {
                if(!empty($key)){
                    $mail->addAttachment( rootPath() . '/image/'.basename($key));
                }
            }

        if($button != false){
            $result = $mail->send();
            echo "It's done";

            //var_dump($result);
            return $result;
        }
        return false;
    }
}