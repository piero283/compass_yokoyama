<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriesFormRequest extends FormRequest
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
            'main_category_name' => 'required|string|max:250|unique:main_categories,main_category',
        ];
    }

    public function messages()
    {
        return [
            'main_category_name.required' => 'メインカテゴリー名は必須です。',
            'main_category_name.unique' => '同じ名前のメインカテゴリーは既に登録されています。',
        ];
    }
}
