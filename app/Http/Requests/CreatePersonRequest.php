<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePersonRequest extends FormRequest
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
            'name' => ['required', 'string', 'min:2', 'max:200'],
            'surname' => ['required', 'string', 'min:2', 'max:200'],
            'byfather' => ['required', 'string', 'min:2', 'max:200'],
            'post' => ['required', 'string', 'min:2', 'max:250'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => 'І`мя',
            'surname' => 'Прізвище',
            'byfather' => 'По-батькові',
            'post' => 'Посада',
        ];
    }

}
