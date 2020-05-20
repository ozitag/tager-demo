<?php


namespace App\Http\Requests\Api\Guest\tours;
use Illuminate\Foundation\Http\FormRequest;

class SearchTourRequest extends FormRequest
{
    public function rules()
    {
        return [
            'datetime_from' => 'string|nullable',
            'datetime_to' => 'string|nullable',
            'baby' => 'integer|nullable',
            'adults' => 'integer|nullable',
            'rating' => 'integer|min:1|max:5',
            'nights' => 'array|nullable|min:2|max:2',
            'nights' => 'array|nullable|min:2|max:2',
            'nights.*' => 'integer',
            'price' => 'array|nullable|min:2|max:2',
            'price.*' => 'numeric',
            'country_id' => 'integer|nullable|exists:countries,id',
            'hotel_id' => 'integer|nullable|exists:hotels,id',
            'to_id' => 'integer|nullable|exists:touroperators,id',
            'agency_id' => 'integer|nullable|exists:agency,id',
        ];
    }
}
