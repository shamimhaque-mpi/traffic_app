<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MoackResponseRequest extends FormRequest
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
            // 'X-Mock-Status' => 'required|in:accepted,failed'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) 
        {
            $mockStatus = $this->header('X-Mock-Status');

            if (!$mockStatus) {
                $validator->errors()->add('X-Mock-Status', 'The X-Mock-Status header is required.');
            } 
            elseif (!in_array($mockStatus, ['accepted', 'failed'])) {
                $validator->errors()->add('X-Mock-Status', 'The X-Mock-Status header must be either accepted or failed.');
            }
        });
    }

    // public function messages()
    // {
    //     return [
    //         'X-Mock-Status.required' => 'The X-Mock-Status header is required.',
    //         'X-Mock-Status.in' => 'The X-Mock-Status header must be either accepted or failed.'
    //     ];
    // }

    // public function headers()
    // {
    //     return $this->only(['X-Mock-Status']);
    // }
}
