<?php
use PHPMailer\PHPMailer\PHPMailer;

require (dirname(__FILE__)."/sendMail_config.php");

$i=0;

$mail = new PHPMailer(true);
$mail->From = $config[sender][email];
$mail->FromName = "TEST";

$mail->addAddress($config[receivers][email], $config[receivers][name]);

$mail->addReplyTo($config[sender][email], $config[sender][name]);

$mail->isHTML(true);

$mail->Subject = "Student Form Registration";

ob_start();
require (dirname(__FILE__)."/message.php");
$body = ob_get_contents();
ob_end_clean();
//var_dump($body);
$mail->Body = $body;
$mail->AltBody = "This is the plain text version of the email content";

$file = $_FILES;

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
    ?>
    <p>Successfully</p>
    <p>You have registered <?php echo $name; ?></p>
    <?php
    echo "Message has been sent successfully";
}
