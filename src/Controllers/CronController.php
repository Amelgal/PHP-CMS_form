<?php
// Этот класс отвечает за вызов PHP MAiler по запросу от cron на OpenServer, а также обновление данных БД после этого

namespace Controllers;

use PHPMailer\PHPMailer\Exception;
use Services\EmailSender;
use Models\UserModel;

class CronController
{
    private $sender;
    private $db_request;

    public function __construct()
    {
        $this->db_request = new UserModel();
        $this->sender = new EmailSender();
    }

    function ActionSendMail()
    {
        $request_result = $this->db_request->selectConfirmed();
        var_dump($request_result);

        foreach ($request_result as $key){
            try {
                $sentResult=$this->sender->sender($key);
                if ($sentResult){
                    $this->db_request->updateConfirmed($key);
                }
            } catch (Exception $e) {
                echo "Mailer Error". $mail->ErrorInfo;
            }
        }

    }
}