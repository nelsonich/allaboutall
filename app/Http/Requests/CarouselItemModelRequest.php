<?php

namespace App\Http\Requests;

use App\Models\CarouselItem;
use Illuminate\Foundation\Http\FormRequest;

class CarouselItemModelRequest extends FormRequest
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
        return CarouselItem::RULES;
    }

    public function messages()
    {
        return [
            'photos.required' => 'Пожалуйста выберите несколько картинки для создания слайдера',
        ];
    }
}
