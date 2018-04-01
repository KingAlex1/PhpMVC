<?php

namespace App\core;


class Template
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }
}
