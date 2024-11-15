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
            'name'          => 'required|string|max:255',
            'description'   => 'required|string|max:255',
            'localization'  => 'required|string|max:255',            
            'start_date'    => 'date',
            'end_date'      => 'date',
            'owner_id'      => 'integer',
            'category_id'   => 'integer',
            'type'          => 'string|max:255',
            'amount'        => 'numeric|between:0,99.99',
            //'start_time'    => 'nullable|date_format:H:i',
            //'end_time'      => 'nullable|date_format:H:i:s|after:start_time',
            //'image'         => 'string|max:255',
        ];
    }
}