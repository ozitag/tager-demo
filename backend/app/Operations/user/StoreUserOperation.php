<?php
namespace App\Operations\user;

use App\Enums\AdministratorRoles;
use App\Http\Requests\Api\Admin\users\CreateUserRequest;
use App\Jobs\Synch\user\StoreUserJob;
use App\Jobs\Synch\user\UpdateUserJob;
use App\Operations\Operation;
use Illuminate\Support\Facades\Hash;

class StoreUserOperation extends Operation
{
    private $request;

    public function __construct(CreateUserRequest $request)
    {
        $this->request = $request;
    }

    public function handle() {
        $user = $this->run(StoreUserJob::class, [
            'request' => $this->request
        ]);
        $this->run(UpdateUserJob::class, [
            'attributes' => [
                'password' => Hash::make($this->request->password),
                'role' => AdministratorRoles::ADMIN
            ],
            'user' => $user
        ]);
    }
}
