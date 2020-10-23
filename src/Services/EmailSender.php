<?php
//Класс отвечающий за содержимое сообщения, а также его оправку по email

namespace Services;

use PHPMailer\PHPMailer\PHPMailer;

class EmailSender
{
    private $senderOptions;

    public function __construct()
    {
        $this->senderOptions = (require __DIR__ . '/../sendMailConfig.php')['config'];
        //var_dump($this->senderOptions);

    }
    public function sender(array $sentData)
    {

        require_once '../vendor/autoload.php';
        $button = true;
        $mail = new PHPMailer(true);
        $mail->From = $this->senderOptions['sender']['email'];
        $mail->FromName = "TEST";

        $mail->addAddress($this->senderOptions['receivers']['email'], $this->senderOptions['receivers']['name']);

        $mail->addReplyTo($this->senderOptions['sender']['email'], $this->senderOptions['sender']['name']);

        $mail->isHTML(true);

        $mail->Subject = "Student Form Registration";

        ob_start();
        require (dirname(__FILE__)."/../../templates/mail/message.php");
        $body = ob_get_contents();
        ob_end_clean();
        $mail->Body = $body;
        $mail->AltBody = "This is the plain text version of the email content";

        $file = [
            'image'=>[
                'image_1' => $sentData['image_1'],
                'image_2' => $sentData['image_2'],
                'image_3' => $sentData['image_3'],
            ]
        ];

            foreach ($file['image'] as $key )
            {
                $mail->addAttachment('../image/'.basename($key));
            }

        if($button != false){
            echo "It's done";
            $result = $mail->send();
            //var_dump($result);
            return $result;
        }
        return false;
    }
}