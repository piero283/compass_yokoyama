<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoriesFormRequest extends FormRequest
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
            'main_category_id' => 'required|exists:main_categories,id',
            'sub_category_name' => 'required|string|max:100|unique:sub_categories,sub_category',
        ];
    }

    public function messages()
    {
        return [
            // メインカテゴリー関連
            'main_category_id.required' => 'メインカテゴリーを選択してください。',
            'main_category_id.exists' => '選択したメインカテゴリーは存在しません。',
            // サブカテゴリー関連
            'sub_category_name.required' => 'サブカテゴリーは必ず入力してください。',
            'sub_category_name.string' => 'サブカテゴリーは文字列で入力してください。',
            'sub_category_name.max' => 'サブカテゴリーは100文字以内で入力してください。',
            'sub_category_name.unique' => 'このサブカテゴリー名はすでに登録されています。',
        ];
    }


}
