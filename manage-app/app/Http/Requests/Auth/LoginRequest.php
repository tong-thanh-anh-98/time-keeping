<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required',
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*[!@#$%^&*()\-_=+{};:,<.>ยง~`|[\]\\/"\'])/'
            ],
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có độ dài tối thiểu là 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một ký tự đặc biệt'
        ];
    }
}
