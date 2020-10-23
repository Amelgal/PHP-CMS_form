<?php


namespace Classes;


use Exceptions\InvalidArgumentException;

class FormValidate
{
    //private $unvalidated_data;

    public function __construct()
    {

    }

    public static function validateForm( )
{
    /*//var_dump($userData);
    var_dump($_POST);
     $userData = $_POST;

    $form_contact_validation = require (dirname(__FILE__) . '/../registrationFormConfig.php');

    foreach ($form_contact_validation as $key_valid=>$item_valid) {
        var_dump($key_valid);
        //var_dump($item_valid);
        foreach ($item_valid as $key=>$item) {
            if($key != 'expression' and $key != 'filter'){
                var_dump($item);

            }
        }


        if (empty($userData[$key_valid])) {
            throw new InvalidArgumentException('Не передан ');
        }
        if ($item_valid['filter'] === 'FILTER_VALIDATE_ARRAY') {
            if ($item_valid['filter']==='FILTER_VALIDATE_ARRAY' && count($form_val[$key_valid])<$item_valid['options']) {
                $error = true;
                $form_error[$key_valid] = $item_values['error_value'][$key_valid];
            }
        }
        else {
            if (!filter_var($form_val[$key_valid], FILTER_VALIDATE_REGEXP, $item_valid['options'])) {
                $error = true;
                $form_error[$key_valid] = $item_values['error_value'][$key_valid];
            }
        }
    }*/

    if ($_POST[full_address][country] == 'Please Select') {
        throw new InvalidArgumentException('Не передан country');
    }


    if (strcasecmp($_POST[full_address][country], "Ukraine") == 0) {
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
    }
    $userData = [
        'name' => $_POST[full_name][first_n] .' '. $_POST[full_name][middle_n].' '.$_POST[full_name][last_n],
        'email' => $_POST[email],
        'birthDate' => $_POST[birth_data][year] .'-'. $_POST[birth_data][month].'-'.$_POST[birth_data][day],
        'gender' => $_POST[gender],
        'address' => $_POST[full_address][country].' '.$_POST[full_address][city].' '.$_POST[full_address][street_address].' '.$_POST[full_address][zip_code],
        'course' => $_POST[course],
        'comment' => $_POST[textarea],
        'countryId' =>  $_country_id,
    ];
    if(!empty($userData['course'])){
        foreach ($userData['course'] as $form_datum) {
            $allCourses = $allCourses." |". $form_datum;
        }
        $userData['course'] = $allCourses;
    }

       if (empty($userData['name']) or $userData['name'] == '  ') {
           throw new InvalidArgumentException('Не передан nickname');
       }
       if (!preg_match('~^[a-zA-Z ]*$~', $userData['name'])) {
           throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита');
       }
       if (empty($userData['email'])) {
           throw new InvalidArgumentException('Не передан email');
       }
       if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
           throw new InvalidArgumentException('Email некорректен');
       }
       if (empty($userData['birthDate']) or $userData['birthDate'] == '--') {
           throw new InvalidArgumentException('Не передан birth day');
       }
       if (empty($userData['address']) or $userData['address'] == 'Please Select   ') {
           throw new InvalidArgumentException('Не передан address');
       }
       if (empty($userData['course'])) {
           throw new InvalidArgumentException('Не передан course');
       }


       return $userData;
}
}