<?php

namespace App\core;

class Validation
{
    public static function checkData(Array $obj)
    {
        foreach ($obj as $key => $value) {
            if ($key != 'photo' && $key!='image') {
                $clear[$key] = strip_tags(trim($value));
            } elseif (preg_match('/jpg/', $_FILES['image']['name'])  //jpg.php
                or preg_match('/png/', $_FILES['image']['name'])
                or preg_match('/jpeg/', $_FILES['image']['name'])
                or preg_match('/gif/', $_FILES['image']['name'])) {
                //Проверяем имя файла. У нас PNG - файл проходит
                if (preg_match('/jpg/', $_FILES['image']['type'])
                    or preg_match('/png/', $_FILES['image']['type'])
                    or preg_match('/jpeg/', $_FILES['image']['type'])
                    or preg_match('/gif/', $_FILES['image']['type'])) {
                    $clear[$key] = $_FILES['image']['name'];
                    //Проверяем mime type - у нас GIF. Все Ок
                    move_uploaded_file($_FILES['image']['tmp_name'], 'photos/' .
                        $_FILES['image']['name']);
                }
            }
        }
        return $clear;
    }

}