<?php

use Illuminate\Support\Facades\Route;

Route::get('/users', 'Api\Guest\UsersController@index');
