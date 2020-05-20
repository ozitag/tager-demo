<?php


namespace App\Jobs\Synch\user;


use App\Repositories\Eloquent\AdministratorRepository;

class StoreUserJob
{
    private $request;

    public function __construct($request)
    {
        $this->request = $request;
    }

    public function handle(AdministratorRepository $repository){
        return $repository->fillAndSave($this->request->getData());
    }
}
