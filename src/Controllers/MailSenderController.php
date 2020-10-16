<?php


namespace Controllers;

use PHPMailer\PHPMailer\Exception;
use Services\Db;
use Services\EmailSender;
//use View\View;

class MailSenderController
{
  //  private $view;
    private $sender;
    private $db;

    public function __construct()
    {
        //$this->view = new View(__DIR__ . '/../../templates');
        $this->db = new Db();
        $this->sender = new EmailSender();
        $this->sendMail();
    }

    function sendMail()
    {
        $dbResult = $this->db->query('SELECT * FROM `regform` WHERE `send_confirmed`= :sendconfirmed LIMIT 3;',
        [
            ':sendconfirmed' => '0',
        ]
        );

        var_dump($dbResult);
        foreach ($dbResult as $key){
            try {
                //var_dump($key['id']);
                $sentResult=$this->sender->sender($key);
                if ($sentResult){
                    $this->db->query( 'UPDATE `regform` SET `send_confirmed` = :sendconfirmed WHERE `regform`.`id` = :id;',
                        [
                            ':sendconfirmed' => '1',
                            ':id'=> $key['id'],
                        ]
                    );
                }
            } catch (Exception $e) {
                echo "Mailer Error". $mail->ErrorInfo;
            }
            var_dump($sentResult);
        }

    }
}