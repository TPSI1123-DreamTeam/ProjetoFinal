<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {  
        return [
            'name'                   => 'required|string|max:255',
            'description'            => 'required|string|max:255',
            'localization'           => 'required|string|max:255',            
            'start_date'             => 'required|date|after_or_equal:today',
            'end_date'               => 'required|date|after_or_equal:start_date',
            'start_time'             => 'required|date_format:H:i',
            'end_time'               => 'required|date_format:H:i',
            'category_id'            => 'required|integer',
            'type'                   => 'required|string|max:255',
            'number_of_participants' => 'required|integer',           
            'suppliers'              => 'nullable'
        ];
    }
}