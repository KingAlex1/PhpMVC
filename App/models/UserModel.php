<?php

namespace App\models;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

$capsule = new Capsule;

$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'test',
    'username' => 'root',
    'password' => 'mars100',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

class UserModel extends Model
{
    public $timestamps = false;
    protected $guarded = ['id'];
    public $table = 'customers';

    public function files()
    {
        return $this->hasMany('App\models\FileModel', 'user_id', 'id');
    }
}