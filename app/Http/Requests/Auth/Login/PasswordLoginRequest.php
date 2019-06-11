<?php

namespace App\Http\Requests\Auth\Login;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PasswordLoginRequest extends FormRequest
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
            'email' => [
                'required',
                'email',
                'exists:emails'
            ],
            'password' => [
                'required_if:login_with,password',
                'nullable',
                'min:9',
                'max:255'
            ],
            'login_with' => [
                'required',
                'in:password,email'
            ]
        ];
    }
}
