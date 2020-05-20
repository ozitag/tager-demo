<?php

namespace App\Http\Controllers\Api\Guest;


use App\Http\Controllers\Controller;
use App\Http\Resources\user\UsersApiResource;
use App\Repositories\Eloquent\AdministratorRepository;

class UsersController extends Controller
{
    public function index(AdministratorRepository $repository){
        return UsersApiResource::collection($repository->all());
    }

}
