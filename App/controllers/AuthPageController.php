<?php

namespace App\controllers;

use App\core\Template;

class AuthPageController extends Template
{
    public function index()
    {
        $this->view->render('authUsers', []);
    }
}