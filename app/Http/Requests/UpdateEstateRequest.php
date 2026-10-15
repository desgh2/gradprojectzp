<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEstateRequest extends FormRequest
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
            'district_id'   => ['required'],
            'name'          => ['required', 'min:2', 'max:300'],
            //'title'         => ['required', 'min:2', 'max:300'],
            'slug'          => ['required', 'min:2', 'max:300'],
            //'heading'       => ['required', 'min:2', 'max:300'],
            //'description'   => ['required', 'min:2', 'max:300'],
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
            'district_id'   => 'Район',
            'name'          => 'Назва',
            'title'         => 'Заголовок (title)',
            'slug'          => 'URL',
            'heading'       => 'Заголовок (H1)',
            'description'   => 'Опис (description)',
        ];
    }
}
