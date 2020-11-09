<?php
// В этом классе происходит обрадотка запроса с формы, с последующей загрухкой в БД ( если не выявлены ошибки)
// также устанавливаются cookies

namespace Controllers;


use Classes\ValidateClass;
use Exceptions\InvalidArgumentException;
use Models\Users\User;
//use Controllers\CronController;

class UsersController extends AbstractController
{
    /*private $view;
    private $validate;
    private $mailSender;

    public function __construct()
    {
        //$this->view = new View(dirname(__FILE__) . '/../../templates');
        //$this->validate = new FormValidate();
        //$this->mailSender = new CronController();
    }*/

    public function ActionSignUp()
    {
        if (!empty($_POST)) {
            setcookie("forma", serialize($_POST), 0, '/');
            try {
                $user = new User(ValidateClass::validateForm());
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/signUp.php', ['error' => $e->getMessage()]);
                return;
            }
            if ($user) {
                $this->view->renderHtml('users/sendSuccessful.php',['nameUser' => $user->getFullUserName(),'successfulImage'=>$user->getSuccessfullImageCount()],$user->getValidateConfirmed());
                return;
            }
        }
        $this->view->renderHtml('users/signUp.php', []);
    }
    public function ActionLogin()
    {
        setcookie('token', null, time()-3600, '/');
        if (!empty($_POST)) {
            try {
                ValidateClass::successfulLogin();
                $login = User::login();
                setcookie('token', serialize($_POST), 0, '/');
                //var_dump($_COOKIE);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('users/login.php', ['error' => $e->getMessage()]);
                return;
            }
            if ($login) {
                header('Location: http://nixcourse.loc/');
                return;
            }
        }
        $this->view->renderHtml('users/login.php');
    }
    public function ActionLogout()
    {
        setcookie('token', null, time()-3600, '/');
        header('Location: http://nixcourse.loc/');
    }
}