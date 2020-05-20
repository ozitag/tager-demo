<?php


namespace App\Http\Requests\Api\Admin\files;


use Illuminate\Foundation\Http\FormRequest;

class FileUploadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file' => 'file|required',
        ];
    }
}
