<?php
// В этом классе хранятся данные и польхователе, также тут происходит валидация данных

namespace Models\Users;

use Exceptions\InvalidArgumentException;
use Models\UserModel;

class User
{
    /** @var string */
    private $successfullImageCount;

    /** @var string */
    private $fullUserName;

    /** @var string */
    private $userNickname;

    /** @var string */
    private $userPassword;

    /** @var string */
    private $email;

    /** @var string */
    private $addressUser;

    /** @var int */
    private $countryId;

    /** @var string */
    private $course;

    /** @var string */
    private $birthDay;

    /** @var string */
    private $gender;

    /** @var string */
    private $createdAt;

    /** @var string */
    private $comment;

    /** @var bool */
    private $isConfirmed;

    /** @var bool */
    private $validateConfirmed = false;

    private $request;

    public function __construct(array $userData)
    {
        $this->request = new UserModel();
        $this->fullUserName = $userData['name'];
        $this->userNickname = $userData['nickname'];
        $this->userPassword = $userData['password'];
        $this->email = $userData['email'];
        $this->addressUser = $userData['address'];
        $this->birthDay = $userData['birthDate'];
        $this->course = $userData['course'];
        $this->gender = $userData['gender'];
        $this->comment = $userData['comment'];
        $this->countryId = $userData['countryId'];
        $this->isConfirmed = false;
        $this->createdAt = date("F j, Y, g:i a");
        $this->validateConfirmed = true;

        $this->successfullImageCount = $this->request->insertUser($userData);

        return $this->validateConfirmed;
    }

    public static function login(){
        $login = new UserModel();
        $isConfirmed = $login ->loginVerify($_POST['nickname']['nickname'],$_POST['password']['password']);
        if ($isConfirmed == false) {
            throw new InvalidArgumentException('Нет такого аккаунта');
        }
        return $isConfirmed;
    }
    /**
     * @return string
     */
    public function getUserNickname(): string
    {
        return $this->userNickname;
    }

    /**
     * @return string
     */
    public function getUserPassword(): string
    {
        return $this->userPassword;
    }
    /**
     * @return string
     */
    public function getValidateConfirmed(): bool
    {
        return $this->validateConfirmed;
    }

    /**
     * @return string
     */
    public function getFullUserName(): string
    {
        return $this->fullUserName;
    }

    /**
     * @return string
     */
    public function getSuccessfullImageCount(): string
    {
        return $this->successfullImageCount;
    }
}