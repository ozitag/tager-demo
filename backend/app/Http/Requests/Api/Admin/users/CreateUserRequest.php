<?php


namespace App\Http\Requests\Api\Admin\users;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'id' => 'integer|nullable|exists:users,id',
            'name' => 'string|required',
            'password' => 'string|required_without:id',
            'email' => 'email|required|unique:users,email,' . $this->id,
        ];
    }

    public function getData() {
        return $this->only(['name', 'email']);
    }
}
