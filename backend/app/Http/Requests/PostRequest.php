<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'content' => 'max:5000',
            'images.*' => 'mimes:jpg,jpeg,png,bmp|max:20000'
        ];
    }

    public function messages()
    {
        return [
            'images.*.mimes' => 'Images must .jpg, .jpeg, .png, .bmp',
            'images.*.max' => 'Images mustn\'t over size 2mb'
        ];
    }
}
