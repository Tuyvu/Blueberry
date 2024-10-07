<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8', // Đảm bảo ít nhất 8 ký tự
                'regex:/[a-z]/', // Chứa ít nhất một chữ cái in thường
                'regex:/[A-Z]/', // Chứa ít nhất một chữ cái in hoa
                'regex:/[0-9]/', // Chứa ít nhất một chữ số
                'regex:/[@$!%*?&#]/', // Chứa ít nhất một ký tự đặc biệt
            ],
        ];
    }
    public function messages(): array
    {
        return [
            'firstname.required' => 'Vui lòng điền tên firstname',
            'lastname.required' => 'Vui lòng điền tên lastname',
            'email.required' => 'Vui lòng điền email',
            'email.email' => 'Email không hợp lệ',
            'email.unique' => 'Email này đã được sử dụng. Vui lòng sử dụng email khác.',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ cái in thường, một chữ cái in hoa, một chữ số, và một ký tự đặc biệt',
        ];
    }
}
