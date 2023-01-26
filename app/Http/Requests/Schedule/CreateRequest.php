<?php

namespace App\Http\Requests\Schedule;

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
            'day' => ['required', 'numeric', 'min:1'],
            'day.*' => ['required', 'exists:days,id'],
            'class' => ['required', 'numeric', 'min:1'],
            'class.*' => ['required', 'exists:class,id'],
            'discipline' => ['required', 'numeric', 'min:1'],
            'discipline.*' => ['required', 'exists:disciplines,id'],
            'numLesson' => ['required', 'numeric', 'min:1'],
            'numLesson.*' => ['required', 'exists:numLessons,id'],

        ];
    }
}
