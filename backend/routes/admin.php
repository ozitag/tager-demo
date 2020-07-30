<?php

use Illuminate\Support\Facades\Route;

Route::post('/upload', \Ozerich\FileStorage\Controllers\UploadController::class . '@index');

Route::group(['namespace' => 'App\Http\Controllers'], function () {

});
