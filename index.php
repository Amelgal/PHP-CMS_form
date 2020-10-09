<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

$button = true;
$connection =  mysqli_connect('127.0.0.1','root','','nixcourse');

if( $connection == false ){
    echo "Yoy lose<br>";
    echo mysqli_connect_error();
    exit();
}
function validate_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = urldecode($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8"/>
	<title> Registration </title>
	<link rel="stylesheet" href="css/style.css">
</head>

<body>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST[full_name][first_n]) and !empty($_POST[full_name][middle_n]) and !empty($_POST[full_name][last_n])) {
        $full_name = validate_input($_POST[full_name][first_n]) . ' ' . validate_input($_POST[full_name][middle_n]) . ' ' . validate_input($_POST[full_name][last_n]);
    } else {
        $nameError = "Имя обязательно";
        $button = false;
    }
    if (!preg_match("~^[a-яA-Я ]*$~",$full_name)) {
        $nameError = "Разрешены только буквы";
        $_POST[full_name][first_n] = "";
        $_POST[full_name][middle_n] = "";
        $_POST[full_name][last_n] = "";
        $button = false;
    }

    if (!empty($_POST[email]))
    {
        $email = validate_input($_POST[email]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $emailError = "Invalid email format";
            $button = false;
        }
    } else {
        $emailError = "Email обязательно";
    }
    if ($_POST[full_address][country] == 'Please Select')
    {
        $countryError = "Выберите страну";
        $button = false;
    }
    if (!empty($_POST[full_address][city]) and !empty($_POST[full_address][zip_code]) and !empty($_POST[full_address][street_address])) {
        $full_address = validate_input($_POST[full_address][city]) . ' ' . validate_input($_POST[full_address][zip_code]) . ' ' . validate_input($_POST[full_address][street_address]);
    }
    if (!preg_match("~^[a-яA-Я./ ]*$~",$full_address)) {
        $_POST[full_address][city] = "";
        $_POST[full_address][zip_code] = "";
        $_POST[full_address][street_address] = "";
    }
}

?>
	
	<form method="POST" enctype='multipart/form-data' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<fieldset>
			<div class="c1">
				<p><h1>Student Registataion Form</h1>Fill out the form carefully for registrarion</p>
			</div>

			<div class="c1">
				<h4>Student Name</h4>
				<div class="flex">
					<div class="input">
						<input type="text" name="full_name[first_n]" value="<?php echo $_POST[full_name][first_n] ?>">
						<p>First Name</p>
					</div>
					<div class="input">
						<input type="text"  name="full_name[middle_n]" value="<?php echo $_POST[full_name][middle_n] ?>">
						<p>Middle Name</p>
					</div>
					<div class="input">
						<input type="text"  name="full_name[last_n]"value="<?php echo $_POST[full_name][last_n] ?>">
						<p>Last Name</p>
					</div>
                    <span class="error">* <?php echo $nameError;?></span>
				</div>
			</div>
			<div class="clear"></div>

            <div class="c1">
                <h4>Email</h4>
                    <div class="input">
                        <input type="text"  name="email" value="<?php echo $_POST[email] ?>">
                        <span class="error">* <?php echo $emailError;?></span>
                        <p>Email</p>

                    </div>
                </div>
            </div>
            <div class="clear"></div>

			<div class="c1">
				<p> <h4>Birth day</h4></p>
				<div class="flex">
                    <div class="input">
                        <select name="birth_data[day]">
                            <option hidden="true"> </option>
                            <option> 5</option>
                            <option> 6</option>
                            <option> 7</option>
                        </select>
                        <p>Day</p>
                    </div>
					<div class="input">
						<select name="birth_data[month]">
							<option hidden="true"> </option>
							<option> May</option>	
							<option> June</option>
							<option> July</option>
						</select>
						<p>Month</p>
					</div>
					<div class="input">
						<select name="birth_data[year]">
							<option hidden="true"> </option>
							<option> 1999</option>
							<option> 2000</option>
							<option> 2001</option>
						</select>
						<p>Year</p>
					</div>
				</div>	


				<div>
				</div>
				<p> <h4>Gender</h4></p>
                <input type="radio" name="gender" checked> Male
                <input type="radio" name="gender"> Female
                </div>
			<div class="clear"></div>


			<div>
				<h4>Adress</h4>
				<div class="colum"> 
					<div class="flex">
						<div class="input">
							<input type="text" name="full_address[city]" value="<?php echo $_POST[full_address][city]?>">
							<p>City</p>
						</div>
						<div class="input">
							<input size="22%" type="text" name="full_address[street_address]" value="<?php echo $_POST[full_address][street_address]?>">
							<p>Street Address</p>
						</div>
					</div>
				</div>

				<div class="colum">
					<div class="flex">
						<div class="input">
							<input type="text" name="full_address[zip_code]" value="<?php echo $_POST[full_address][zip_code]?>">
							<p>Postal/Zip Code</p>
						</div>
						<div class="input">
							<select name="full_address[country]"">
								<option hidden="true"> Please Select</option>
								<option> Ukraine</option>
								<option> USA</option>
								<option> Japan</option>
								<option> England</option>
							</select>
                            <span class="error">* <?php echo $countryError;?></span>
							<p>Country</p>
						</div>
					</div>
				</div>
			</div>


			<div>
				<h4>Courses</h4>
				<select name="course" value="<?php echo $_POST[course]?>">
					<option hidden="truie"></option>>
					<option>Windows 10</option>
					<option>Windows 8</option>
					<option>Windows 7</option>
					<option>Windows Xp</option>
				</select>
			</div>

            <div>
                <h4>Send files</h4>
                <input type="file" accept="image/bmp,image/jpeg,image/png" name="image[]">
                <input type="file" accept="image/bmp,image/jpeg,image/png" name="image[]">
                <input type="file" accept="image/bmp,image/jpeg,image/png" name="image[]">
            </div>
		</div>


		<div>
			<h4>Additional Comments</h4>
			<textarea cols="100" rows="10" name="textarea"></textarea>
		</div>


		<input class="button1" type="submit" value="Submit Application">
		<input class="button2" type="reset"  value="Clear Fields">
	</fieldset>
</form>
    <hr/>

    <pre>
        <div class="div">
<?php

$name = $_POST[full_name][first_n] .' '. $_POST[full_name][middle_n].' '.$_POST[full_name][last_n];
$email = $_POST[email];
$birth_date = $_POST[birth_data][year] .'-'. $_POST[birth_data][month].'-'.$_POST[birth_data][day];
$gender = $_POST[gender];
$address = $_POST[full_address][country].' '.$_POST[full_address][city].' '.$_POST[full_address][street_address].' '.$_POST[full_address][zip_code];
$course = $_POST[course];
$comment = $_POST[textarea];

foreach ($_FILES["image"]["error"] as $key => $error)
{
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["image"]["tmp_name"][$key];
        $uploadfile = 'image/'.basename($_FILES["image"]["name"][$key]);
        if (!(move_uploaded_file($tmp_name, $uploadfile))) {
            echo "Возможная атака с помощью файловой загрузки!\n";
            $button = false;
        }
    }
}

//if (strcasecmp($_POST[full_address][country], "Ukraine") == 0) {
//    $_country_id = 1;
//}
//if (strcasecmp($_POST[full_address][country], "USA") == 0) {
//    $_country_id =2;
//}
//if (strcasecmp($_POST[full_address][country], "Japan") == 0) {
//    $_country_id =3;
//}
//if (strcasecmp($_POST[full_address][country], "England") == 0) {
//    $_country_id =4;
//}

$result = $button;// mysqli_query($connection," INSERT INTO regform ( name, birth_date, gender, adress, cours,country_id, comment) VALUES
//			('".$_POST[full_name][first_n] .' '. $_POST[full_name][middle_n].' '.$_POST[full_name][last_n]."',
//			'".$_POST[birth_data][year] .'-'. $_POST[birth_data][month].'-'.$_POST[birth_data][day]."' ,
//			'".$_POST[gender]."',
//			'".$_POST[full_address][street_address].' '.$_POST[full_address][city].'  '.$_POST[full_address][zip_code]."',
//			'".$_POST[course]."',
//			'".$_country_id."',
//			'".$_POST[textarea]."'
//			)
//			") or die("Error " . mysqli_error($connection));
if($result)
{
    ?>
        <p>Successfully</p>
        <p>You have registered <?php echo $name; ?></p>

    <?php
}
?>
</pre>


<?php
try {
$mail = new PHPMailer(true);
$mail->From = "myblogcodeactivation@gmail.com";
$mail->FromName = "TEST";

$mail->addAddress("yevhenii.shalko@nure.ua", "Student");

$mail->addReplyTo("myblogcodeactivation@gmail.com", "Reply");

$mail->isHTML(true);

$mail->Subject = "Student Form Registration";
$mail->Body = "Hello,". $name.'<br>'.
    "You filled out the form, here is your data.<br>
     Email: ".$email."<br>
     Birth data: ".$birth_date."<br>
     Gender: ".$gender."<br>
     Your address: ".$address."<br>
     Course: ".$course."<br>
     Your comment: ".$comment."<br>
     Also attached your files to the message<br>"
;
$mail->AltBody = "This is the plain text version of the email content";

    foreach ($_FILES["image"]["name"] as $key => $name)
    {
        $mail->addAttachment('image/'.basename($_FILES["image"]["name"][$key]));
    }
    if(!($button == false)){
        $mail->send();
        echo "Message has been sent successfully";
    }
} catch (Exception $e) {
    echo "Mailer Error". $mail->ErrorInfo;
}
?>
</div>
</body>
</html>