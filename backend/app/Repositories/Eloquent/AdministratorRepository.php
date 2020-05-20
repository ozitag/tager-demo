<?php

namespace App\Repositories\Eloquent;

use App\Models\Administrator;

class AdministratorRepository extends BaseRepository
{
    public function __construct(Administrator $model)
    {
        parent::__construct($model);
    }
}
