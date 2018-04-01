<?php

namespace App\core;

trait TwigTemplates
{

    public function getNav($filename,$content)    {
        $loader = new \Twig_Loader_Filesystem('App/views');
        $twig = new \Twig_Environment($loader);
        $file =  "App/views/" . $filename;
        echo $twig->render( "$file" , ["nav" => $content]);
    }

}
