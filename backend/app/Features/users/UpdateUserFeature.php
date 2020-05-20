<?php
namespace App\Features\users;


use App\Features\Feature;
use App\Http\Requests\Api\Admin\users\CreateUserRequest;
use App\Jobs\Synch\user\UpdateUserJob;
use App\Models\Wrap;
use Illuminate\Support\Facades\Hash;

class UpdateUserFeature extends Feature
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function handle(CreateUserRequest $request){

        $this->run(UpdateUserJob::class, [
            'attributes' => $request->getData(),
            'user' => $this->user
        ]);

        if($request->password) {

            $this->run(UpdateUserJob::class, [
                'attributes' => [
                    'password' => Hash::make($request->password)],
                'user' => $this->user
            ]);
        }
    }
}
