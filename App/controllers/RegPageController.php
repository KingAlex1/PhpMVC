<?php

namespace App\controllers;

use App\core\Auth;
use App\core\Template;
use App\models\UserModel;

class RegPageController extends Template
{
    public function index()
    {
        $auth = new Auth();
        if ($auth->isAuth()) {
            $userInfo = UserModel::all()->where('id', '=', $_SESSION['user']);
            $data = $userInfo->toArray();
        }
        $userInfo = UserModel::all()->where('id', '=', $_SESSION['user']);
        $data = $userInfo->toArray();

//        $this->view->render('regUsers.html', []);
        $this->view->twigLoad('regUsers.html.php', ["data" => $data]);
    }
}
