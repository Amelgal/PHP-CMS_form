<?php


namespace Models;

use Services\DB_Model;

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new DB_Model();
    }

    public function insertUser(array $form_data)
    {
        $successfullImage = 0;

        if(!empty($_FILES["image"]["name"])){

            foreach ($_FILES["image"]["error"] as $key => $error)
            {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["image"]["tmp_name"][$key];
                    $uploadfile = rootPath().'/image/'.basename($_FILES["image"]["name"][$key]);
                    if (move_uploaded_file($tmp_name, $uploadfile)) {
                        $successfullImage++;
                    } else {
                        echo "Возможная атака с помощью файловой загрузки!\n";
                    }
                }
            }
        }
         $this->db->query('INSERT INTO `users` (`name`, `nickname`, `password`, `birth_date`, `gender`, `adress`, `cours`, `country_id`, `comment`,`face_img`,`passport_img`,`code_img`)
                                  VALUES ( :name, :nickname, :password, :birth_date,  :gender,  :adress, :cours, :country_id, :comment, :face_img, :passport_img, :code_img);',
             [
                 ':name' => $form_data['name'],
                 ':nickname' => $form_data['nickname'],
                 ':password' => $form_data['password'],
                 ':birth_date' => $form_data['birthDate'],
                 ':gender' => $form_data['gender'],
                 ':adress' => $form_data['address'],
                 ':cours' => $form_data['course'],
                 ':country_id' => $form_data['countryId'],
                 ':comment' => $form_data['comment'],
                 ':face_img' => $_FILES["image"]["name"][0],
                 ':passport_img' => $_FILES["image"]["name"][1],
                 ':code_img' => $_FILES["image"]["name"][2],
             ], static::class
         );
           //var_dump($this->db->getLastInsertId());
         $this->db->query('INSERT INTO `cron_line` (`user_id`,`email`) 
                                  VALUES ( :user_id, :email);',
             [
                 ':user_id' => $this->db->getLastInsertId(),
                 ':email' => $form_data['email'],
             ], static::class
         );

        return $successfullImage;
    }

    public function selectConfirmed()
    {
        $dbResult = $this->db->query('SELECT * FROM `cron_line` LEFT JOIN users ON `users`.`user_id`=`cron_line`.`user_id` WHERE `send_confirmed`= :sendconfirmed LIMIT 3;',
            [
                ':sendconfirmed' => 0,
            ]
        );
        return $dbResult;
    }
    public function updateConfirmed(array $key)
    {
        $this->db->query( 'UPDATE `cron_line` SET `send_confirmed` = :sendconfirmed WHERE `cron_line`.`user_id` = :user_id;',
            [
                ':sendconfirmed' => '1',
                ':user_id'=> $key['user_id'],
            ]
        );
    }
    public function loginVerify(string $nickname, string $password){
        $dbResult = $this->db->query('SELECT `nickname`,`password` FROM `users` WHERE `nickname`= :nickname AND `password`= :password;',
            [
                ':nickname' => $nickname,
                ':password'=> $password,

            ]
        );
        if (empty($dbResult)){
            return false;
        }
        return true;
    }
}