<?php

namespace Models\Users;

use Exceptions\InvalidArgumentException;

class User
{
    /** @var string */
    private $fullUserName;

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

    /**
     * @return string
     */
    public function getFullUserName(): string
    {
        return $this->fullUserName;
    }

    public static function signUp(array $userData) : User
    {
        //var_dump($userData);
        if (empty($userData['name']) or $userData['name'] == '  ') {
            throw new InvalidArgumentException('Не передан nickname');
        }
        if (!preg_match('~^[a-zA-Z ]*$~', $userData['name'])) {
            throw new InvalidArgumentException('Nickname может состоять только из символов латинского алфавита');
        }
        if (empty($userData['email'])) {
            throw new InvalidArgumentException('Не передан email');
        }
        if (!filter_var($userData['email'], FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email некорректен');
        }
        if (empty($userData['birthDate']) or $userData['birthDate'] == '--') {
            throw new InvalidArgumentException('Не передан birth day');
        }
        if (empty($userData['address']) or $userData['address'] == 'Please Select   ') {
            throw new InvalidArgumentException('Не передан address');
        }
        if (empty($userData['course'])) {
            throw new InvalidArgumentException('Не передан course');
        }

        $user = new User();
        $user->fullUserName = $userData['name'];
        $user->email = $userData['email'];
        $user->addressUser = $userData['address'];
        $user->birthDay = $userData['birthDate'];
        $user->course = $userData['course'];
        $user->gender = $userData['gender'];
        $user->comment = $userData['comment'];
        $user->countryId = $userData['countryId'];
        $user->isConfirmed = false;
        $user->createdAt = date("F j, Y, g:i a");
        $user->validateConfirmed = true;

        return $user;
    }
    /**
     * @return string
     */
    public function getValidateConfirmed(): bool
    {
        return $this->validateConfirmed;
    }
}