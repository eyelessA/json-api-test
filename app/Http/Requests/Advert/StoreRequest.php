<?php

namespace App\Http\Requests\Advert;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:200'],
            'description' => ['required', 'string', 'max:1000'],
            'images' => ['required', 'array', 'max:3'],
            'images.*.url' => ['required', 'url'],
            'price' => ['required', 'integer']
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Название объявления обязательно.',
            'name.string' => 'Название объявления должно быть строкой.',
            'name.max' => 'Название объявления не должно превышать 200 символов.',
            'description.required' => 'Описание объявления обязательно.',
            'description.string' => 'Описание объявления должно быть строкой.',
            'description.max' => 'Описание объявления не должно превышать 1000 символов.',
            'images.required' => 'Изображения обязательны.',
            'images.array' => 'Изображения должны быть массивом.',
            'images.max' => 'Максимальное количество изображений - 3.',
            'images.*.url.required' => 'URL изображения обязателен.',
            'images.*.url.url' => 'URL изображения должен быть валидным.',
            'price.required' => 'Цена обязательна.',
            'price.integer' => 'Цена должна быть числом.'
        ];
    }
}
