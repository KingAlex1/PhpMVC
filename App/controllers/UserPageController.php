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
//      Get data from DB and render its to page
        $files = UserModel::all();
        $data = $files->toArray();
//        $this->view->render('list', $data);
        $this->view->twigLoad('list.php', ["data" =>$data] );
    }
}