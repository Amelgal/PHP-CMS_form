<?php


namespace Models;

use Services\Db;

class DbRequest
{
    private $db;
    public function __construct()
    {
        $this->db = new Db();
    }

    public function insert(array $form_data)
    {
        $successfullImage = 0;
        if(!empty($_FILES["image"]["name"])){

            foreach ($_FILES["image"]["error"] as $key => $error)
            {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $_FILES["image"]["tmp_name"][$key];
                    $uploadfile = (dirname(__FILE__)).'/../../image/'.basename($_FILES["image"]["name"][$key]);
                    //var_dump($uploadfile);
                    if (move_uploaded_file($tmp_name, $uploadfile)) {
                        $successfullImage++;
                    } else {
                        echo "Возможная атака с помощью файловой загрузки!\n";
                    }
                }
            }
        }
         /*$this->db->query('INSERT INTO `regform` (`name`, `birth_date`, `gender`, `adress`, `cours`, `country_id`, `comment`,`email`,`image_1`,`image_2`,`image_3`)
                                  VALUES ( :name, :birth_date,  :gender,  :adress, :cours, :country_id, :comment, :email, :image_1, :image_2, :image_3);',
             [
                 ':name' => $form_data['name'],
                 ':birth_date' => $form_data['birthDate'],
                 ':gender' => $form_data['gender'],
                 ':adress' => $form_data['address'],
                 ':cours' => $form_data['course'],
                 ':country_id' => $form_data['countryId'],
                 ':comment' => $form_data['comment'],
                 ':email' => $form_data['email'],
                 ':image_1' => $_FILES["image"]["name"][0],
                 ':image_2' => $_FILES["image"]["name"][1],
                 ':image_3' => $_FILES["image"]["name"][2],
             ], static::class
         );*/
        return $successfullImage;
    }

    public function selectConfirmed()
    {
        $dbResult = $this->db->query('SELECT * FROM `regform` WHERE `send_confirmed`= :sendconfirmed LIMIT 3;',
            [
                ':sendconfirmed' => 0,
            ]
        );
        return $dbResult;
    }
    public function updateConfirmed(array $key)
    {
        $this->db->query( 'UPDATE `regform` SET `send_confirmed` = :sendconfirmed WHERE `regform`.`id` = :id;',
            [
                ':sendconfirmed' => '1',
                ':id'=> $key['id'],
            ]
        );
    }
}