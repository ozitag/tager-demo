<?php


namespace App\Http\Requests\Api\Guest\auth;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'string|required',
            'email' => 'string|required',
            'password' => 'string|required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'email is required',
            'password.required'  => 'Password is required',
        ];
    }
}
