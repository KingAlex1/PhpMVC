<?php

namespace App\controllers;

use App\core\Auth;
use App\core\Template;
use App\core\TwigTemplates;
use App\models\UserModel;


class FilePageController extends Template
{
    use TwigTemplates;

    public function index()
    {
        $auth = new Auth();
        if (!$auth->isAuth()) {
            header('location:/');
        }
        $orders = UserModel::with('files')->get()->where('id', '=', $_SESSION['user']);
        $data = $orders->toArray();
//      $this->view->render('filelist.html', $data);
        $this->view->twigLoad('filelist.php', ["data" => $data]);

    }
}