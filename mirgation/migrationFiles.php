<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once "../App/models/FileModel.php";

Capsule::schema()->dropIfExists('files');

Capsule::schema()->create('files', function (Blueprint $table) {
    $table->increments('id');
    $table->integer('user_id')->nullable();
    $table->string('filename');
    $table->string('desc');
    $table->string('image');


});