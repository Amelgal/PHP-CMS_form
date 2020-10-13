<?php
//if ($_GET['use'] == "1"){
//setcookie("use", $_GET['use'],time() + 60  , '/');
//};

setcookie("forma", serialize($_POST), time() + 600, '/');


use PHPMailer\PHPMailer\Exception;

$cookies = unserialize(stripslashes($_COOKIE['forma']));


require_once 'vendor/autoload.php';
require (dirname(__FILE__).'/config/connect_Db.php');


    $button = true;

function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = urldecode($data);
    return $data;
}
require (dirname(__FILE__)."/config/validate_config.php");



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title> Registration </title>
    <link rel="stylesheet" href="/css/style.css">
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
              require (dirname(__FILE__)."/form.php");
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
        require_once (dirname(__FILE__)."/config/sendMail.php");
    } catch (Exception $e) {
        echo "Mailer Error". $mail->ErrorInfo;
}
}

?>
</pre>
</div>
</body>
</html>