<?php

namespace App\controllers;

use App\core\Request;
use App\core\Validation;
use App\models\FileModel;

class FileController
{
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function addImage()
    {

        $validData = Validation::checkData([
            'user_id' => $this->request->session('user'),
            'filename' => $this->request->post('filename'),
            'desc' => $this->request->post('desc'),
            'image' => $this->request->file('image')['name']
        ]);
        echo "<pre>";
        var_dump($validData);
        try {
            FileModel::create($validData);
        } catch (\Exception $e) {
            echo "Упс !! Вы ввели не валидные данные , попробуйте еще раз " . $e->getMessage();
        }
        header('location:/FilePageController');
    }

    public function deleteImage(){
        $order = FileModel::find($this->request->post('id'));
        $delOrder = $order->delete();
        $delPic = $this->request->post('pic');
        unlink("photos/$delPic");
        if ($delOrder) {
            header('location:/FilePageController');
        }
    }

}
