<?php

namespace App\core;

class Validation
{
    public static function checkData(Array $obj)
    {
        foreach ($obj as $key => $value) {
            if ($key != 'photo' && $key != 'image') {
                $clear[$key] = strip_tags(trim($value));
            } elseif (preg_match('/jpg/', $obj['image'] ?? $obj['photo'])  //jpg.php
                or preg_match('/png/', $obj['image'] ?? $obj['photo'])
                or preg_match('/jpeg/', $obj['image'] ?? $obj['photo'])
                or preg_match('/gif/', $obj['image']) ?? $obj['photo']) {
                //Проверяем имя файла. У нас PNG - файл проходит
                if (preg_match('/jpg/', $_FILES['image']['type'] ?? $_FILES['photo']['type'])
                    or preg_match('/png/', $_FILES['image']['type'] ?? $_FILES['photo']['type'])
                    or preg_match('/jpeg/', $_FILES['image']['type'] ?? $_FILES['photo']['type'])
                    or preg_match('/gif/', $_FILES['image']['type'] ?? $_FILES['photo']['type'])) {
                    $clear[$key] = $obj['image'] ?? $obj['photo'];
                    //Проверяем mime type - у нас GIF. Все Ок
                }
            }
        }
        return $clear;
    }
}