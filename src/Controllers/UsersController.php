<?php
// В этом классе происходит обрадотка запроса с формы, с последующей загрухкой в БД ( если не выявлены ошибки)
// также устанавливаются cookies

namespace Controllers;


use Exceptions\InvalidArgumentException;
use Models\Users\User;
use Services\Db;
use Services\EmailSender;
use View\View;

class UsersController
{
    /** @var View */
    private $view;
    private $sender;
    private $db;
    private $successfulImage;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
        $this->db = new Db();
        $this->sender = new EmailSender();
    }

    public function signUp()
    {
        //time() + 600
        if (!empty($_POST)) {
            setcookie("forma", serialize($_POST), 0, '/');

            try {
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
                $form_data = [
                    'name' => $_POST[full_name][first_n] .' '. $_POST[full_name][middle_n].' '.$_POST[full_name][last_n],
                    'email' => $_POST[email],
                    'birthDate' => $_POST[birth_data][year] .'-'. $_POST[birth_data][month].'-'.$_POST[birth_data][day],
                    'gender' => $_POST[gender],
                    'address' => $_POST[full_address][country].' '.$_POST[full_address][city].' '.$_POST[full_address][street_address].' '.$_POST[full_address][zip_code],
                    'course' => ($_POST[course]),
                    'comment' => $_POST[textarea],
                    'countryId' =>  $_country_id,
                ];
                if(!empty($form_data['course'])){
                    foreach ($form_data['course'] as $form_datum) {
                        $allCourses = $allCourses." |". $form_datum;
                    }
                    $form_data['course'] = $allCourses;
                }
                //var_dump($_FILES);
                $user = User::signUp($form_data);
                //var_dump($user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }
            if ($user instanceof User) {
                $this->insert($form_data, $_FILES);
                $this->view->renderHtml('users/sendSuccessful.php',['nameUser' => $user->getFullUserName(),'successfulImage'=>$this->successfulImage],$user->getValidateConfirmed());
                //$this->sendMail();
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php', []);
    }

    public function insert(array $form_data, array $file_data)
    {
        $this->successfulImage = 0;
        //var_dump($form_data);
        if(!empty($file_data["image"]["name"])){

            foreach ($file_data["image"]["error"] as $key => $error)
            {
                if ($error == UPLOAD_ERR_OK) {
                    $tmp_name = $file_data["image"]["tmp_name"][$key];
                    $uploadfile = (dirname(__FILE__)).'/../../image/'.basename($file_data["image"]["name"][$key]);
                    //var_dump($uploadfile);
                    if (move_uploaded_file($tmp_name, $uploadfile)) {
                        $this->successfulImage++;
                    } else {
                        echo "Возможная атака с помощью файловой загрузки!\n";
                    }
                }
            }
        }
        $this->db->query('INSERT INTO `regform` (`name`, `birth_date`, `gender`, `adress`, `cours`, `country_id`, `comment`,`email`,`image_1`,`image_2`,`image_3`)
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
                ':image_1' => $file_data["image"]["name"][0],
                ':image_2' => $file_data["image"]["name"][1],
                ':image_3' => $file_data["image"]["name"][2],
            ], static::class
        );

    }
    /*public function sendMail()
    {
        $dbResult = $this->db->query('SELECT * FROM `regform`ORDER BY id DESC LIMIT 1;');
        try {
            $sentResult=$this->sender->sender($dbResult);
        } catch (Exception $e) {
            echo "Mailer Error". $mail->ErrorInfo;
        }
        var_dump($sentResult);
    }*/
}