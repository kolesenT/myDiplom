<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class SingInRequest extends FormRequest
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
            'email' => ['required', 'email:rfc', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:25', 'confirmed'],
        ];
    }
}
