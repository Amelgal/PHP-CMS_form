<?php


//$form_data=[
//    name => $_POST[full_name][first_n] .' '. $_POST[full_name][middle_n].' '.$_POST[full_name][last_n],
//    email => $_POST[email],
//    birth_date => $_POST[birth_data][year] .'-'. $_POST[birth_data][month].'-'.$_POST[birth_data][day],
//    gender => $_POST[gender],
//    address => $_POST[full_address][country].' '.$_POST[full_address][city].' '.$_POST[full_address][street_address].' '.$_POST[full_address][zip_code],
//    course => $_POST[course],
//    comment => $_POST[textarea],
//];
$form_data = $_POST;
var_dump($form_data);

$name = $_POST[full_name][first_n] .' '. $_POST[full_name][middle_n].' '.$_POST[full_name][last_n];
$email = $_POST[email];
$birth_date = $_POST[birth_data][year] .'-'. $_POST[birth_data][month].'-'.$_POST[birth_data][day];
$gender = $_POST[gender];
$address = $_POST[full_address][country].' '.$_POST[full_address][city].' '.$_POST[full_address][street_address].' '.$_POST[full_address][zip_code];
//$course = $_POST[course];
$comment = $_POST[textarea];

//var_dump($_FILES);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST[full_name][first_n]) and !empty($_POST[full_name][middle_n]) and !empty($_POST[full_name][last_n])) {
        $full_name = validate_input($name);
    } else {
        $nameError = "Имя обязательно";
        $button = false;
    }
    if (!preg_match("~^[a-яA-Я ]*$~",$full_name)) {
        $nameError = "Разрешены только буквы и пробелы";
        $_POST[full_name][first_n] = "";
        $_POST[full_name][middle_n] = "";
        $_POST[full_name][last_n] = "";
        $button = false;
    }

    if (!empty($email))
    {
        $email = validate_input($email);
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
        $full_address = validate_input($address);
    }
    if (!preg_match("~^[a-яA-Я\.\/ ]*$~",$full_address)) {
        $_POST[full_address][city] = "";
        $_POST[full_address][zip_code] = "";
        $_POST[full_address][street_address] = "";
    }
}

