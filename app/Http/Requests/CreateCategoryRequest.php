<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name'          => ['required', 'min:2', 'max:255'],
            'title'         => ['required', 'min:2', 'max:255'],
            'slug'          => ['required', 'min:2', 'max:255', 'unique:category'],
            'heading'       => ['required', 'min:2', 'max:255'],
            'description'   => ['required', 'min:2', 'max:250'],
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
            'name'          => 'Назва',
            'title'         => 'Заголовок (title)',
            'slug'          => 'URL',
            'heading'       => 'Заголовок (H1)',
            'description'   => 'Опис (description)',
        ];
    }
}
