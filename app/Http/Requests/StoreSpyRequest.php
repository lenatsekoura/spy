<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSpyRequest extends FormRequest
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
            'name' => 'required|unique:spies', 
            'surname' => 'required|unique:spies',
            'dob' => 'required|date_format:Y-m-d',
            'dod' => 'sometimes|date_format:Y-m-d',
            'agency' => 'sometimes|not_in:CIA|not_in:MIA',            
        ];
    }
}
