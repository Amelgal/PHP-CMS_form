<?php
// Этот класс отвечает за вызов PHP MAiler по запросу от cron на OpenServer, а также обновление данных БД после этого

namespace Controllers;

use PHPMailer\PHPMailer\Exception;
use Services\Db;
use Services\EmailSender;
use Models\DbRequest;

class MailSenderController
{
    private $sender;
    private $db;
    private $db_request;

    public function __construct()
    {
        $this->db = new Db();
        $this->db_request = new DbRequest();
        $this->sender = new EmailSender();
    }

    function sendMail()
    {

        $request_result = $this->db_request->selectConfirmed();
        //var_dump($dbResult);
        foreach ($request_result as $key){
            try {
                $sentResult=$this->sender->sender($key);
                if ($sentResult){
                    $this->db_request->updateConfirmed($key);
                }
            } catch (Exception $e) {
                echo "Mailer Error". $mail->ErrorInfo;
            }
            //var_dump($sentResult);
        }

    }
}