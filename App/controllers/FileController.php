<?php

namespace App\controllers;

use App\core\Request;
use App\core\Validation;
use App\models\FileModel;

class FileController
{
    protected $sold;
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->sold = substr(microtime(), 2, 5);
    }

    public function addImage()
    {
        try {
            $clearData = \GUMP::is_valid([
                'user_id' => $this->request->session('user'),
                'filename' => $this->request->post('filename'),
                'desc' => $this->request->post('desc'),
                'image' => ($this->request->file('image')['name'])
            ], ['user_id' => 'required|alpha_numeric',
                'filename' => 'required|alpha_numeric|max_len,100|min_len,4',
                'desc' => 'required|alpha_numeric|min_len,4',
                'image' => 'required'
            ]);

            if ($clearData === true) {
                $validData = Validation::checkData([
                    'user_id' => $this->request->session('user'),
                    'filename' => $this->request->post('filename'),
                    'desc' => $this->request->post('desc'),
                    'image' => ($this->sold . $this->request->file('image')['name'])
                ]);
            } else {
                throw new \Exception($clearData[0]);
            }

            if ($validData) {
                FileModel::create($validData);
                header('location:/FilePageController');
            } else {
                throw new \Exception("Ошибка!! , проверьте введденные данные");
            }

            if ($validData['image']) {
                move_uploaded_file($_FILES['image']['tmp_name'],
                    'photos/' . $this->sold . $_FILES['image']['name']);
            } else {
                throw new \Exception("Загружать можно только картинки!!!");
            }
        } catch (\Exception $e) {
            require "App/core/errors/404.php";
        }
    }

    public function deleteImage()
    {
        $order = FileModel::find($this->request->post('id'));
        $delOrder = $order->delete();
        $delPic = $this->request->post('pic');
        unlink("photos/{$delPic}");
        if ($delOrder) {
            header('location:FilePageController');
        }
    }
}
