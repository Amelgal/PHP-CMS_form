<?php

namespace Controllers;

use Elementor\User;
use PHPMailer\PHPMailer\Exception;
use Services\Db;
use Services\EmailSender;
use View\View;


class MainController
{
    private $view;

    private $db;

    private $sender;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
        $this->db = new Db();
        $this->sender = new EmailSender();
    }
    public function main()
    {
//        $articles = [
//            ['name' => 'Статья 1', 'text' => 'Текст статьи 1'],
//            ['name' => 'Статья 2', 'text' => 'Текст статьи 2'],
//        ];
        $this->view->renderHtml('main/main.php', []);

    }
    public function sayHello()
    {
        $dbResult = $this->db->query('SELECT * FROM `regform` WHERE id= :id;',
            [':id' => 1]
        );
        try {
            $sentResult=$this->sender->sender();
        } catch (Exception $e) {
            echo "Mailer Error". $mail->ErrorInfo;
        }
        //var_dump($bodySender);
        //var_dump($result[0]);
        //var_dump($sentResult);
        $this->view->renderHtml('users/sendSuccessful.php',['sentUser' => $dbResult[0]],$sentResult);
    }

    /*= mysqli_query($this->db->connection," INSERT INTO regform ( name, birth_date, gender, adress, cours,country_id, comment) VALUES
			('".$user->fullUserName."',
            '".$user->birthDay."',
			'".$user->gender."',
			'".$user->addressUser."',
			'".$user->course."',
			'".$user->countryId."',
			'".$user->comment."'
			)
			")or die("Error " . mysqli_error($connection));*/
}
