<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomDateRequest extends FormRequest
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
            'over_name' =>'required|string|max:10',
            'under_name' =>'required|string|max:10',
            'over_name_kana' =>'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'under_name_kana' =>'required|string|regex:/^[ァ-ヶー]+$/u|max:30',
            'mail_address' =>'required|email|unique:users,mail_address',
            'sex' =>'required|in:1,2,3',
            'birth_day' => [
                'required',
                function ($attribute, $value, $fail) {
                    $year = $this->input('old_year');
                    $month = $this->input('old_month');
                    $day = $this->input('old_day');

                    if (!ctype_digit($year) || !ctype_digit($month) || !ctype_digit($day)) {
                        return $fail('生年月日は数値で入力してください。');
                    }

                    $year = (int)$year;
                    $month = (int)$month;
                    $day = (int)$day;

                    if ($year < 1900 || $year > date('Y')) {
                        return $fail('生年月日の年が範囲外です。');
                    }

                    if (!checkdate($month, $day, $year)) {
                        return $fail('存在しない日付が指定されています。');
                    }
                },
            ],
            'role' =>'required|in:1,2,3,4',
            'password' =>'required|between:8,30|confirmed',
        ];
    }

    protected function prepareForValidation()
    {
        // old_year, old_month, old_day を結合して birth_day を作成
        $this->merge([
            'birth_day' => sprintf('%04d-%02d-%02d', $this->input('old_year'), $this->input('old_month'), $this->input('old_day')),
        ]);
    }

    public function messages()
    {
        return [
            'over_name.required' => '姓を入力してください。',
            'under_name.required' => '名を入力してください。',
            'over_name_kana.required' => '姓のカナを入力してください。',
            'under_name_kana.required' => '名のカナを入力してください。',
            'mail_address.required' => 'メールアドレスを入力してください。',
            'mail_address.unique' => 'このメールアドレスはすでに登録されています。',
            'birth_day.required' => '存在しない生年月日です。',
            'password.required' => 'パスワードを入力してください。',
            'password.confirmed' => '確認用パスワードが一致しません。',
        ];
    }
}
