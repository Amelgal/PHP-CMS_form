<?php


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
        $i=0;
        $sentData = $sentData[0];
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
        var_dump($body);
        $mail->Body = $body;
        $mail->AltBody = "This is the plain text version of the email content";

        $file = $_FILES;

        if(!empty($file["image"]["name"])){

            foreach ($file["image"]["error"] as $key => $error)
            {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $file["image"]["tmp_name"][$key];
                    $uploadfile = (dirname(__FILE__)).'/../../image/'.basename($file["image"]["name"][$key]);
                    //var_dump($uploadfile);
                    if (move_uploaded_file($tmp_name, $uploadfile)) {
                        $i++;
                    } else {
                        echo "Возможная атака с помощью файловой загрузки!\n";
                        $button = false;
                    }
                }
            }
            echo "Успешно переданых изображений ".$i."\n";


            foreach ($file["image"]["name"] as $key => $name)
            {
                $mail->addAttachment('../image/'.basename($file["image"]["name"][$key]));
            }
        }
        if($button != false){
            echo "It's done";
            $result = $mail->send();
            var_dump($result);
        }
        return true;//$mail->send();
    }
}