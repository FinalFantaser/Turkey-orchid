<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApartmentSearchRequest extends FormRequest
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
            'price_from' => 'required|integer|gte:0',
            'price_to' => 'required|integer|gte:0',
            'm2_from' => 'required|integer|gte:0',
            'm2_to' => 'required|integer|gte:0',
            'date' => 'nullable|string',
            'rooms' => 'required|string',
        ];
    } //rules

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new \Illuminate\Http\Response(['error' => $validator->errors()->first()], 422);
        throw new \Illuminate\Validation\ValidationException($validator, $response);
    } //failedValidation
}
