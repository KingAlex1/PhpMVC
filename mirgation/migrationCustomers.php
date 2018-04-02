<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as Capsule;

require_once "../App/models/UserModel.php";

Capsule::schema()->dropIfExists('customers');

Capsule::schema()->create('customers', function (Blueprint $table) {
    $table->increments('id');
    $table->string('login')->unique();
    $table->string('password')->unique();
    $table->string('name');
    $table->integer('age');
    $table->string('description');
    $table->string('photo');
    $table->string('sold');

});
