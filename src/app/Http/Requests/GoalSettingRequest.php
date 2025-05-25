<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GoalSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'weight' => [
                'required',
                'regex:/^\d{1,4}(\.\d)?$/'
            ],
            'target_weight' => [
                'required',
                'regex:/^\d{1,4}(\.\d)?$/'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'weight.required' => '現在の体重を入力してください',
            'weight.regex' => '4桁までの数字で入力してください 小数点は1桁で入力してください',
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.regex' => '4桁までの数字で入力してください 小数点は1桁で入力してください',
        ];
    }
}