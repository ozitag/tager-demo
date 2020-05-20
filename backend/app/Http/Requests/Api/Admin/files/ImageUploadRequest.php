<?php


namespace App\Http\Requests\Api\Admin\files;


use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
{
    public function rules()
    {
        return [
            'file' => 'image|required',
        ];
    }

    public function messages()
    {
        return [
            'file.image' => 'Только изображения поддерживаются',
        ];
    }
}
