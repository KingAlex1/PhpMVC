<?php

namespace App\core;

use Twig_Environment;

class View
{
    protected $twig;
    protected $loader;

    public function render(String $filename, array $data)
    {
  //      extract($data);
        require_once __DIR__ . "/../views/" . $filename .".php";
    }

    public function __construct($data = [])
    {
        $this->loader = new \Twig_Loader_Filesystem('App/views');
        $this->twig = new Twig_Environment($this->loader);
    }

    public function twigLoad(String $filename, array $data)
    {
            echo $this->twig->render($filename, $data);
    }


}