<?php
// Этот класс отвечает за вызов PHP MAiler по запросу от cron на OpenServer, а также обновление данных БД после этого

namespace Controllers;

use PHPMailer\PHPMailer\Exception;
use Services\Db;
use Services\EmailSender;

class MailSenderController
{
    private $sender;
    private $db;

    public function __construct()
    {
        $this->db = new Db();
        $this->sender = new EmailSender();
    }

    function sendMail()
    {
        $dbResult = $this->db->query('SELECT * FROM `regform` WHERE `send_confirmed`= :sendconfirmed LIMIT 3;',
        [
            ':sendconfirmed' => '0',
        ]
        );

        //var_dump($dbResult);
        foreach ($dbResult as $key){
            try {
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