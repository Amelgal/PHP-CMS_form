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
         /*$this->db->query('INSERT INTO `users` (`name`, `birth_date`, `gender`, `adress`, `cours`, `country_id`, `comment`,`email`,`face_img`,`passport_img`,`code_img`)
                                  VALUES ( :name, :birth_date,  :gender,  :adress, :cours, :country_id, :comment, :email, :face_img, :passport_img, :code_img);',
             [
                 ':name' => $form_data['name'],
                 ':birth_date' => $form_data['birthDate'],
                 ':gender' => $form_data['gender'],
                 ':adress' => $form_data['address'],
                 ':cours' => $form_data['course'],
                 ':country_id' => $form_data['countryId'],
                 ':comment' => $form_data['comment'],
                 ':email' => $form_data['email'],
                 ':face_img' => $_FILES["image"]["name"][0],
                 ':passport_img' => $_FILES["image"]["name"][1],
                 ':code_img' => $_FILES["image"]["name"][2],
             ], static::class
         );*/
        return $successfullImage;
    }

    public function selectConfirmed()
    {
        $dbResult = $this->db->query('SELECT * FROM `users` WHERE `send_confirmed`= :sendconfirmed LIMIT 3;',
            [
                ':sendconfirmed' => 0,
            ]
        );
        return $dbResult;
    }
    public function updateConfirmed(array $key)
    {
        $this->db->query( 'UPDATE `users` SET `send_confirmed` = :sendconfirmed WHERE `regform`.`id` = :id;',
            [
                ':sendconfirmed' => '1',
                ':id'=> $key['id'],
            ]
        );
    }
}