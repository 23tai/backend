<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FindRequest extends FormRequest
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
            //
            'team_id' => 'string|max:30|nullable',
        ];
    }

    public function messages()
    {
        return [
            //
           'team_id.string' => '↓文字列で入力して下さい。',
           'team_id.max' => '↓30文字以内で入力して下さい。',
        ];
    }
}
