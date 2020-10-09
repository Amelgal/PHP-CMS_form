<?php
use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer(true);
$mail->From = "myblogcodeactivation@gmail.com";
$mail->FromName = "TEST";

$mail->addAddress("yevhenii.shalko@nure.ua", "Student");

$mail->addReplyTo("myblogcodeactivation@gmail.com", "Reply");

$mail->isHTML(true);

$mail->Subject = "Student Form Registration";

ob_start();
require (dirname(__FILE__)."/sendMail.php");
$body = ob_get_contents();
ob_end_clean();
var_dump($body);
$mail->Body = $body;
$mail->AltBody = "This is the plain text version of the email content";
if(!empty($file["image"]["name"])){

    foreach ($file["image"]["error"] as $key => $error)
    {
        if ($error == UPLOAD_ERR_OK) {
            $tmp_name = $file["image"]["tmp_name"][$key];
            $uploadfile = 'image/'.basename($file["image"]["name"][$key]);
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
        $mail->addAttachment('image/'.basename($file["image"]["name"][$key]));
    }
}

if(!($button == false)){
    //$mail->send();
    echo "Message has been sent successfully";
}
