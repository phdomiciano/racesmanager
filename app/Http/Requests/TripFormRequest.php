<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'street_origin' => ['required', 'min:2'], 
            'number_origin' => ['required'], 
            'district_origin' => ['required', 'min:2'], 
            'country_origin' => ['required', 'min:2'],
            'street_destination' => ['required', 'min:2'], 
            'number_destination' => ['required'], 
            'district_destination' => ['required', 'min:2'], 
            'country_destination' => ['required', 'min:2']
        ];
    }
}
