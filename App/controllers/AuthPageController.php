<?php

namespace App\controllers;

use App\core\Auth;
use App\core\Template;
use App\models\UserModel;

class AuthPageController extends Template
{
    public function index()
    {
        $auth = new Auth();
        if ($auth->isAuth()) {
            $userInfo = UserModel::all()->where('id', '=', $_SESSION['user']);
            $data = $userInfo->toArray();
        }
        $this->view->twigLoad('authUsers.php', ["data" => $data]);
    }
}