<?php

namespace App\controllers;

use App\core\Template;

class RegPageController extends Template
{
    public function index()
    {
        $this->view->render('regUsers.html', []);
    }
}