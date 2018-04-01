<?php

namespace App\controllers;

use App\core\Auth;
use App\core\Request;
use App\models\FileModel;
use App\models\UserModel;

class PostController
{
    public function signOut()
    {
        $serviceAuth = new Auth();
        $serviceAuth->logout();
        header('location:/');
    }
}