<?php
namespace App\Features\users;

use App\Features\Feature;
use App\Http\Requests\Api\Admin\users\CreateUserRequest;
use App\Operations\user\StoreUserOperation;

class StoreUserFeature extends Feature
{
    public function handle(CreateUserRequest $request){
        $this->run(StoreUserOperation::class, [
            'request' => $request
        ]);
    }
}
