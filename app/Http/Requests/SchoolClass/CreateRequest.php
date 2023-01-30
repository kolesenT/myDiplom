<?php

namespace App\Http\Requests\SchoolClass;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'num' => ['required', 'numeric'],
            'letter' => ['string', 'min:1', 'max:2'],
            'users' => ['numeric', 'min:1'],
            'users.*' => ['exists:user_info,id'],
        ];
    }
}
