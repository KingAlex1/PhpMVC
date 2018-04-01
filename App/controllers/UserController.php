<?php

namespace App\controllers;

use App\core\Request;
use App\core\Validation;
use App\core\Auth;
use App\models\UserModel;
use Couchbase\Exception;

class UserController
{
    public $request;
    protected $sold;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->sold = substr(microtime(), 2, 5);
    }

    public function getHash($password, $sold)
    {

        return hash('sha256', $password . $sold);
    }

    public function singUp()
    {
        try {
            if ($this->request->post('password') === $this->request->post('checkPassword')) {
                $validData = Validation::checkData([
                    'login' => $this->request->post('login'),
                    'password' => $this->getHash($this->request->post('password'), $this->sold),
                    'name' => $this->request->post('name'),
                    'age' => $this->request->post('age'),
                    'description' => $this->request->post('description') ?? 'noDescription',
                    'photo' => $this->request->file('image')['name'],
                    'sold' => $this->sold
                ]);

            } else {
                throw new \Exception('Ошибка !!! Вы ввели разные пароли, попробуйте еще раз.');
            }
            if ($validData) {
                $user = UserModel::create($validData);
            } else {
                throw new \Exception('Ошибка !!! Вы ввели не валидные данные , попробуйте еще раз.');
            }
        } catch (\Exception $e) {
            require "App/core/errors/404.php";
        }
//      Authorization
        $serviceAuth = new Auth();
        $serviceAuth->login($user['id']);
        header('location:/UserPageController');
    }

    public function singIn()
    {
//      Get data from DB
        try {
            $login = UserModel::all()->where('login', '=', $this->request->post('log'));
            $user = array_pop($login->toArray());
            if (!$user) {
                throw new \Exception("Ошибка!!! Вы ввели неверный логин, попробуйте еще раз .");
            }
//      Check data
            $matched = ($this->getHash($this->request->post('pass'), $user['sold']) ===
                $user['password']);

            if (!$matched) {
                throw new \Exception("Ошибка !!! Вы ввели не верный пароль , попробуйте еще раз .");
            } else {
                //      Authorization
                $serviceAuth = new Auth();
                $serviceAuth->login($user['id']);
                header('location:/UserPageController');
            }
        } catch (\Exception $e) {
            require "App/core/errors/404.php";
        }

    }

    public function deleteUser()
    {
        $user = UserModel::find($this->request->post('id'));
//        $user = UserModel::with('files')->get()->where('id', '=',
            $this->request->post('id');
//        echo "<pre>";
//        var_dump($user);
        $delUser = $user->delete();
        $delPic = $this->request->post('pic');
        unlink("photos/$delPic");
        if ($delUser) {
            header('location:UserPageController');
        }
    }


}
