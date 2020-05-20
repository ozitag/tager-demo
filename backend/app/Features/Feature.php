<?php


namespace App\Features;

use App\Http\Traits\MarshalTrait;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;

class Feature
{
    use DispatchesJobs;
    use MarshalTrait;

    public function run($feature, $arguments = [])
    {
        return $this->dispatchNow($this->marshal($feature, new Collection(), $arguments));
    }
}
