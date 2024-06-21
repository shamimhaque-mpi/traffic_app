<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTransactionRequest extends FormRequest
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
            'status' => 'required|in:success,failed'
        ];
    }

    public function messages()
    {
        return [
            'status.required' => 'The status is required.',
            'status.in' => 'The status must be one of the following values: success,failed.'
        ];
    }
}
