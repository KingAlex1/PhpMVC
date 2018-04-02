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
                $clearData = \GUMP::is_valid([
                    'login' => $this->request->post('login'),
                    'password' => $this->request->post('password'),
                    'name' => $this->request->post('name'),
                    'age' => $this->request->post('age'),
                    'description' => $this->request->post('description') ?? 'noDescription',
                    'photo' => $this->sold . $this->request->file('image')['name'],
                    'sold' => $this->sold
                ], ['login' => 'required|alpha_numeric|min_len,4',
                    'password' => 'required|alpha_numeric|min_len,4',
                    'name' => 'required|alpha_numeric|min_len,4',
                    'age' => 'required|max_len,3',
                    'description' => 'max_len,200',
                    'photo' => 'required',
                    'sold' => 'required'
                ]);
            } else {
                throw new \Exception("Ошибка !!! Вы ввели разные пароли ,  попробуйте еще раз");
            }
            if ($clearData === true) {
                $validData = Validation::checkData([
                    'login' => $this->request->post('login'),
                    'password' => $this->getHash($this->request->post('password'), $this->sold),
                    'name' => $this->request->post('name'),
                    'age' => $this->request->post('age'),
                    'description' => $this->request->post('description') ?? 'noDescription',
                    'photo' => $this->sold . $this->request->file('image')['name'],
                    'sold' => $this->sold
                ]);
            } else {
                throw new \Exception($clearData[0]);
            }
            if ($validData) {
                $user = UserModel::create($validData);
                $serviceAuth = new Auth();
                $serviceAuth->login($user['id']);
                header('location:/UserPageController');
            }
            if ($validData['photo']) {
                move_uploaded_file($_FILES['image']['tmp_name'],
                    'photos/' . $this->sold . $_FILES['image']['name']);
            } else {
                throw new \Exception("Упс, Загрузите картинку");
            }
        } catch (\Exception $e) {
            require "App/core/errors/404.php";
        }
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
        $userPic = UserModel::with('files')->get()->where('id', '=',
        $this->request->post('id'));

        foreach ($userPic as $key=>$value){
            foreach ($value['files'] as $item => $i ){
                $i->delete();
                $delPic = $i['image'];
                echo $delPic;
                unlink("photos/$delPic");
            }
        }
        $delUser = $user->delete();
        $delAva = $this->request->post('pic');
        unlink("photos/$delAva");
        if ($delUser) {
            header('location:UserPageController');
        }
        if ($_SESSION['user'] === $user->toArray()['id']) {
            $serviceAuth = new Auth();
            $serviceAuth->logout();
        }
    }
}
