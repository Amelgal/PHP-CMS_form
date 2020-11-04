<?php


namespace Classes;


use Exceptions\InvalidArgumentException;

class RegistrationValidate
{
    //private $unvalidated_data;

//    public function __construct()
//    {
//    }

    public static function validateForm( )
{
    $allCourses = '';
    $_country_id = 0;

    $userData = $_POST;
    $form_contact_validation = require (dirname(__FILE__) . '/../registrationFormConfig.php');

    foreach ($form_contact_validation as $key_valid=>$item_valid) {
        foreach ($userData as $key_form=>$item_form) {

            if ($key_valid == $key_form){

                foreach ($item_valid as $key=>$item) {
                    foreach ($item_form as $k =>$it){

                        if ($key == $k){
//                            var_dump($item);
//                            var_dump($it);
                            if (empty($it)) {
                                throw new InvalidArgumentException($item['error']);
                            } else if (!filter_var($it, $item['filter'], array(
                                "options" => array("regexp"=>$item['regexp'])
                            ))) {
                                throw new InvalidArgumentException($item['error']);
                            }
                            //echo ".....................................";
                        }
                    }
                }
            }
        }
    }


//    if ($_POST['full_address']['country'] == 'Please Select') {
//        throw new InvalidArgumentException('Не передан country');
//    }

    //var_dump($userData);
    if (strcasecmp($userData['full_address']['country'], "Ukraine") == 0) {
        $_country_id = 1;
    }
    if (strcasecmp($userData['full_address']['country'], "USA") == 0) {
        $_country_id =2;
    }
    if (strcasecmp($userData['full_address']['country'], "Japan") == 0) {
        $_country_id =3;
    }
    if (strcasecmp($userData['full_address']['country'], "England") == 0) {
        $_country_id =4;
    }
    $userData = [
        'name' => $userData['full_name']['first_n'] .' '. $userData['full_name']['middle_n'].' '.$userData['full_name']['last_n'],
        'email' => $userData['email']['email'],
        'birthDate' => $userData['birth_data']['year'] .'-'. $userData['birth_data']['month'].'-'.$userData['birth_data']['day'],
        'gender' => $userData['gender']['gender'],
        'address' => $userData['full_address']['country'].' '.$userData['full_address']['city'].' '.$userData['full_address']['street_address'].' '.$userData['full_address']['zip_code'],
        'course' => $userData['course'],
        'comment' => $userData['textarea']['textarea'],
        'countryId' =>  $_country_id,
    ];
    if(!empty($userData['course'])){
        foreach ($userData['course'] as $form_datum) {
            $allCourses = $allCourses." |". $form_datum;
        }

        $userData['course'] = $allCourses;
        var_dump($userData);
    }

//       if (empty($userData['name']) or $userData['name'] == '  ') {
//           throw new InvalidArgumentException('Не передан nickname');
//       }
//       if (!preg_match('~^[a-zA-Z ]*$~', $userData['name'])) {
//           throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита');
//       }
//       if (empty($userData['email']['email'])) {
//           throw new InvalidArgumentException('Не передан email');
//       }
////       if (!filter_var($userData['email']['email'], FILTER_VALIDATE_EMAIL)) {
////           throw new InvalidArgumentException('Email некорректен');
////       }
//       if (empty($userData['birthDate']) or $userData['birthDate'] == '--') {
//           throw new InvalidArgumentException('Не передан birth day');
//       }
//       if (empty($userData['address']) or $userData['address'] == 'Please Select   ') {
//           throw new InvalidArgumentException('Не передан address');
//       }
//       if (empty($userData['course'])) {
//           throw new InvalidArgumentException('Не передан course');
//       }


       return $userData;
}
//    public static function SuccessfullImageCount(){
//
//    }
}