<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryModelRequest extends FormRequest
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
        $rules = Category::RULES;

        if (is_null($this->request->get('id'))) {
            $rules += ['background' => 'required'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'Пожалуйста заполните название категории',
            'background.required' => 'Пожалуйста выберите изображение категории'
        ];
    }
}
