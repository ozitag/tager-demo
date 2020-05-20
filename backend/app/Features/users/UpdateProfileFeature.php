<?php


namespace App\Features\users;


use App\Features\Feature;
use App\Http\Requests\Api\Admin\users\CreateUserRequest;
use App\Http\Requests\Api\Admin\users\UpdateProfileRequest;
use App\Http\Resources\user\UsersResource;
use App\Models\Wrap;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdateProfileFeature extends Feature
{
    private $user;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function handle(UpdateProfileRequest $request){
        $this->user->update($request->only('name', 'phone', 'address', 'email'));
        if($request->password) {
            $this->user->password = Hash::make($request->password);
        }
        $this->user->save();
        return new UsersResource($this->user);
    }
}
