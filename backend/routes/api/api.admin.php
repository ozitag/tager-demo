<?php

use Illuminate\Support\Facades\Route;

Route::get('/users', 'Api\Guest\UsersController@index');

// *********** File Upload *********** //

Route::post('/upload', 'Api\Admin\UploadController@store');

// *********** *********** *********** //
