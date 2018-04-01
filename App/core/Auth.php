<?php

namespace App\core;

class Auth
{
    const INDEX = 'user';

    public function isAuth()
    {
        return (!empty($_SESSION[self::INDEX]));
    }

    public function getUser()
    {
        if ($this->isAuth()) {
            return $_SESSION[self::INDEX];
        }
    }

    public function login($userId)
    {
        if ($userId < 1) {
            throw new \Exception();
        }
        $_SESSION[self::INDEX] = $userId;
    }

    public function logout()
    {
        $_SESSION[self::INDEX] = null;
    }
}