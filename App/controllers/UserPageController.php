<?php

namespace App\controllers;

use App\core\Auth;
use App\core\Template;
use App\models\UserModel;

class UserPageController extends Template
{
    public function index()
    {
//      Authorization
        $auth = new Auth();
        if (!$auth->isAuth()) {
            header('location:/');
        }
        $userInfo = UserModel::all()->where('id', '=', $_SESSION['user']);
        $data = $userInfo->toArray();
        $files = UserModel::all();
        $users = $files->toArray();
        $this->view->twigLoad('list.php', ["data" => $data, "user" => $users]);
    }
}
