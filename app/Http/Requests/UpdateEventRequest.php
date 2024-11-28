<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
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
            'name'                   => 'nullable|string|max:255',
            'description'            => 'nullable|string',
            'localization'           => 'nullable|string|max:255',            
            'start_date'             => 'nullable|date|after_or_equal:today',
            'end_date'               => 'nullable|date|after_or_equal:start_date',
            'start_time'             => 'nullable|date_format:H:i',
            'end_time'               => 'nullable|date_format:H:i',
            'category_id'            => 'nullable|integer',
            'type'                   => 'nullable|string|max:255',
            'number_of_participants' => 'nullable|integer',           
            'suppliers'              => 'nullable',
            'services_default_array' => 'nullable',
        ];
    }
}
