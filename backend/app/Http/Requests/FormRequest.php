<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class FormRequest
 * @package App\Http\Requests
 *
 */
class FormRequest extends \Illuminate\Foundation\Http\FormRequest
{
    /**
     * Handle a failed validation attempt.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $errorMessages = $validator->errors()->getMessages();

        $errors = [];
        foreach ($errorMessages as $errorField => $errorFieldData) {
            $errors[$errorField] = $errorFieldData[1];
        }

        throw new HttpResponseException(response()->json([
            'errors' => $errors,
        ], 400));
    }
}
