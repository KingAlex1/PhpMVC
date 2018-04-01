<?php

error_reporting(E_ALL);
session_start();

require __DIR__ . "/vendor/autoload.php";

use App\controllers\UserController;
use App\controllers\FileController;
use App\controllers\PostController;
use App\core\Request;

$routes = explode('/', $_SERVER['REQUEST_URI']);

if ($_POST) {
    $request = new Request($_GET, $_POST, $_SERVER, $_COOKIE, $_FILES, $_SESSION);
    //Registration
    if (isset($_POST['login'])) {
        $controller = new UserController($request);
        $controller->singUp();
    } //Authorization
    elseif (isset($_POST['log'])) {
        $controller = new UserController($request);
        $controller->singIn();
    } // Add image
    elseif (isset($_POST['filename'])) {
        $controller = new FileController($request);
        $controller->addImage();
    } // Delete user
    elseif (isset($_POST['delete'])) {
        $controller = new UserController($request);
        $controller->deleteUser();
    } // Delete image
    elseif (isset($_POST['del'])) {
        $controller = new FileController($request);
        $controller->deleteImage();
    }
}

$controllerName = "AuthPageController";
$actionName = "index";

if (!empty($routes[1])) {
    $controllerName = $routes[1];
}
if (!empty($routes[2])) {
    $actionName = $routes[2];
}

$fileName = sprintf("App/controllers/%s.php", $controllerName);

$files = scandir("App/controllers");
foreach ($files as $key => $item) {
    if (strtolower($item) == strtolower($controllerName)) {
        $fileName = sprintf("App/controllers/%s.php", $item);
        $controllerName = $item;
        var_dump($fileName);
    }
}

try {
    if (file_exists($fileName)) {
        require_once $fileName;
    } else {
        throw new Exception("File not found in controller directory !!!!");
    }
    $className = "\App\\controllers\\" . $controllerName;
    if (class_exists($className)) {
        $controller = new $className;
    } else {
        throw new Exception("File found but class not found");
    }
    if (method_exists($controller, $actionName)) {
        $controller->$actionName();
    } else {

        throw new Exception("Method not found");
    }
} catch (Exception $e){
    require "App/core/errors/404.php";
}
