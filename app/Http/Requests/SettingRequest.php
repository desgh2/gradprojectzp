<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'name'          => ['required', 'min:2', 'max:300'],
            'title'         => ['required', 'min:2', 'max:300'],
            'description'   => ['required', 'min:2', 'max:300'],
            'text'          => ['required', 'min:2', 'max:300'],
            'work_time'     => ['required', 'min:2', 'max:300'],
            'address'       => ['required', 'min:2', 'max:300'],
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
            'description'   => 'Опис (description)',
            'text'          => 'Контент',
            'work_time'     => 'Час роботи',
            'address'       => 'Адреса',
        ];
    }
}
