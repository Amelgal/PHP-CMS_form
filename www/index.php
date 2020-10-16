<?php
    //  функцию автозагрузки
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/../src/' . $className . '.php';
    });

    // р    оутинг
    $route = $_GET['route'] ?? '';
    $routes = require __DIR__ . '/../src/routes.php';

    $isRouteFound = false;
    foreach ($routes as $pattern => $controllerAndAction) {
        preg_match($pattern, $route, $matches);
        if (!empty($matches)) {
            $isRouteFound = true;
            break;
        }
    }

    if (!$isRouteFound) {
        echo 'Страница не найдена!';
        return;
    }
    unset($matches[0]);
//var_dump(...$matches);

    $controllerName = $controllerAndAction[0];
    $actionName = $controllerAndAction[1];

    $controller = new $controllerName();
    //передаст элементы массива в качестве аргументов методу в том порядке, в котором они находятся в массиве
    $controller->$actionName(...$matches);



/*require_once '../vendor/autoload.php';

$i=0;
$senderOptions = (require __DIR__ . '/../src/sendMailConfig.php')['config'];
$mail = new PHPMailer(true);
$mail->From = $senderOptions['sender']['email'];
$mail->FromName = "TEST";

$mail->addAddress($senderOptions['receivers']['email'], $senderOptions['receivers']['name']);

$mail->addReplyTo($senderOptions['sender']['email'], $senderOptions['sender']['name']);

$mail->isHTML(true);

$mail->Subject = "Student Form Registration";

ob_start();
require (dirname(__FILE__)."/../templates/mail/message.php");
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
            $uploadfile = (dirname(__FILE__)).'/../image/'.basename($file["image"]["name"][$key]);
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
}*/
/*//if ($_GET['use'] == "1"){
//setcookie("use", $_GET['use'],time() + 60  , '/');
//};





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title> Registration </title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<?php
//var_dump($_GET);
//if (empty($_COOKIE['use'])):?>
<!--<form method="GET" action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?><!--">-->
<!--<input type="submit" name="Save" value="Ok">-->
<!--<input type="submit" name="Close" value="Not Ok">-->
<!--<input type="hidden" name="use" value="1">-->
<!--</form>-->
<?php
//  if($_GET["Save"] == 'Ok'):
//  var_dump($_GET);
//  require (dirname(__FILE__)."/form.php");
//  endif;
?>
<?php
//else:
              require(dirname(__FILE__) . "/../form.php");
//endif;
?>
    <hr/>
    <pre>
        <div class="div">
<?php

//var_dump($form_data);
//var_dump($cook);
/*if (strcasecmp($_POST[full_address][country], "Ukraine") == 0) {
    $_country_id = 1;
}
if (strcasecmp($_POST[full_address][country], "USA") == 0) {
    $_country_id =2;
}
if (strcasecmp($_POST[full_address][country], "Japan") == 0) {
    $_country_id =3;
}
if (strcasecmp($_POST[full_address][country], "England") == 0) {
    $_country_id =4;
}*/
/*
$result = $button; //mysqli_query($connection," INSERT INTO regform ( name, birth_date, gender, adress, cours,country_id, comment) VALUES
//			('".$name."',
//            '".$birth_date."',
//			'".$gender."',
//			'".$address."',
//			'".$course."',
//			'".$_country_id."',
//			'".$comment."'
//			)
//			")or die("Error " . mysqli_error($connection));
if($result)
{
    try {
        require_once(dirname(__FILE__) . "/../config/sendMail.php");
    } catch (Exception $e) {
        echo "Mailer Error". $mail->ErrorInfo;
}
}

?>
</pre>
</div>
</body>
</html>*/