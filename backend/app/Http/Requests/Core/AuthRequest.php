<?php

namespace App\Http\Requests\Core;

use App\Http\Requests\FormRequest;

/**
 * Class AuthRequest
 * @package App\Http\Requests\Api\Guest\auth
 *
 * @var string $email
 * @var string $password
 */
class AuthRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'string|required',
            'password' => 'string|required'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ];
    }
}
