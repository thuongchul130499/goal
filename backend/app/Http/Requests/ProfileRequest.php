<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'bio' => 'max:2000',
            'password' => 'min:6',
            'phone' => 'required|regex:/[0-9]{10}/'
        ];
    }

    public function messages()
    {
        return [
            'phone.regex' => 'Số điện thoại phải 10 số',
        ];
    }
}
