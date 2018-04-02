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
        $clearData = \GUMP::is_valid([
            'user_id' => $this->request->session('user'),
            'filename' => $this->request->post('filename'),
            'desc' => $this->request->post('desc'),
            'image' => ($this->sold . $this->request->file('image')['name'])
        ], ['user_id' => 'required',
            'filename' => 'required|max_len,100|min_len,2',
            'desc' => 'required|max_len,200|min_len,2',
            'image' => 'required'
        ]);

        if ($clearData) {
            $validData = Validation::checkData([
                'user_id' => $this->request->session('user'),
                'filename' => $this->request->post('filename'),
                'desc' => $this->request->post('desc'),
                'image' => ($this->sold . $this->request->file('image')['name'])
            ]);
        }
        if ($validData['image']) {
            move_uploaded_file($_FILES['image']['tmp_name'],
                'photos/' . $this->sold . $_FILES['image']['name']);
        }

        try {
            FileModel::create($validData);
        } catch (\Exception $e) {
            echo "Упс !! Вы ввели не валидные данные , попробуйте еще раз " . $e->getMessage();
        }
        header('location:/FilePageController');
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
