<?php
// В этом классе происходит обрадотка запроса с формы, с последующей загрухкой в БД ( если не выявлены ошибки)
// также устанавливаются cookies

namespace Controllers;


use Exceptions\InvalidArgumentException;
use Models\Users\User;
use View\View;
use Classes\FormValidate;
use Controllers\MailSenderController;

class UsersController
{
    /** @var View */
    private $view;
    private $validate;
    private $mailSender;

    public function __construct()
    {
        $this->view = new View(__DIR__ . '/../../templates');
        $this->validate = new FormValidate();
        $this->mailSender = new MailSenderController();
    }

    public function signUp()
    {
        if (!empty($_POST)) {
            setcookie("forma", serialize($_POST), 0, '/');
            try {
                $user = new User($this->validate::validateForm());
                //var_dump($user);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }
            if ($user) {
                // Поставил отправку на почту сюда, но работает через cron от OpenServer.
                // Отправляет три сообщения
                $this->mailSender->sendMail();
                $this->view->renderHtml('users/sendSuccessful.php',['nameUser' => $user->getFullUserName(),'successfulImage'=>$user->getSuccessfullImageCount()],$user->getValidateConfirmed());
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php', []);
    }
}