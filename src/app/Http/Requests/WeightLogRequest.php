<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'regex:/^\d{1,3}(\.\d)?$/'],
            'calories' => ['required', 'integer', 'min:0'],
            'exercise_time' => ['required', 'date_format:H:i'],
            'exercise_detail' => ['nullable', 'string', 'max:120'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください',
            'date.date' => '正しい日付形式で入力してください',

            'weight.required' => '体重を入力してください',
            'weight.numeric' => '体重は数値で入力してください',
            'weight.regex' => '体重は最大3桁＋小数1桁で入力してください',

            'calories.required' => '摂取カロリーを入力してください',
            'calories.integer' => '摂取カロリーは整数で入力してください',
            'calories.min' => '摂取カロリーは0以上で入力してください',

            'exercise_time.required' => '運動時間を入力してください',
            'exercise_time.date_format' => '運動時間は「時:分」の形式で入力してください',

            'exercise_detail.max' => '運動内容は120文字以内で入力してください',
        ];
    }
}