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
            'start_date'             => 'date|after:now',
            'end_date'               => 'date|after:now',
            'owner_id'               => 'integer',
            'category_id'            => 'integer',
            'type'                   => 'string|max:255',
            'amount'                 => 'between:0,999999.99',
            'start_time'             => 'date_format:H:i',
            'end_time'               => 'date_format:H:i|after:start_time',
            'number_of_participants' => 'nullable|integer',
            'image'                  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'event_confirmation'     => 'nullable|boolean',
        ];
    }
}