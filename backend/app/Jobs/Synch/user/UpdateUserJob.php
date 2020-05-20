<?php


namespace App\Jobs\Synch\user;

use App\Repositories\Eloquent\AdministratorRepository;

class UpdateUserJob
{
    private $user;
    private $attributes;

    public function __construct($user, $attributes)
    {
        $this->user = $user;
        $this->attributes = $attributes;
    }

    public function handle(AdministratorRepository $repository){
        $repository->set($this->user);
        $repository->update($this->attributes);
    }
}
