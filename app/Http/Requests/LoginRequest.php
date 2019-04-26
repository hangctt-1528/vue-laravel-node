<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => __('validation.required', [
                'attribute' => __('labels.reset_password.email'),
            ]),
            'email.email' => __('validation.email', [
                'attribute' => __('labels.reset_password.email'),
            ]),
            'email.exists' => __('validation.exists', [
                'attribute' => __('labels.reset_password.email'),
            ]),
            'password.required' => __('validation.required', [
                'attribute' => __('labels.reset_password.password'),
            ]),
        ];
    }
}
