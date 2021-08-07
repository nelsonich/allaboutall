<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;

class UserModelRequest extends FormRequest
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
        $rules = User::RULES;

        if (is_null($this->request->get('id'))) {
            $rules += ['password' => 'required'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Поле имени обязательно для заполнения',
            'email.required' => 'Электронная почта обязательна',
            'email.email' => 'Неверное поле электронной почты',
            'password.required' => 'Поле пароля обязательно для заполнения'
        ];
    }
}
