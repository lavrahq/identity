<?php

namespace App\Http\Requests\Auth\Setup;

use Illuminate\Foundation\Http\FormRequest;

class InitialSetupRequest extends FormRequest
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
                'exists:emails,id'
            ],
            'username' => [
                'required',
                'unique:users,username',
                'min:3',
                'max:255'
            ],
            'login_with' => [
                'required',
                'in:password,links'
            ]
        ];
    }
}
