<?php


namespace App\Operations;


use App\Http\Traits\JobDispatcherTrait;
use App\Http\Traits\MarshalTrait;
use Illuminate\Foundation\Bus\DispatchesJobs;

abstract class Operation
{
    use MarshalTrait;
    use DispatchesJobs;
    use JobDispatcherTrait;
}
