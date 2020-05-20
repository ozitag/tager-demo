<?php


namespace App\Http\Traits;


use App\Events\JobStarted;
use App\Events\OperationStarted;
use App\Jobs\Job;
use App\Jobs\Operation;
use ReflectionClass;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

trait JobDispatcherTrait
{
    /**
     * beautifier function to be called instead of the
     * laravel function dispatchFromArray.
     * When the $arguments is an instance of Request
     * it will call dispatchFrom instead.
     *
     * @param string                         $job
     * @param array|Request $arguments
     * @param array                          $extra
     *
     * @return mixed
     */
    public function run($job, $arguments = [])
    {
        if ($arguments instanceof Request) {
            $result = $this->dispatch($this->marshal($job, $arguments, $extra));
        } else {
            if (!is_object($job)) {
                $job = $this->marshal($job, new Collection(), $arguments);
            }
            $result = $this->dispatch($job, $arguments);
        }
        return $result;
    }
}
