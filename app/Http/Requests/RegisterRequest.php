<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username'         => 'required|string|min:3|max:30|unique:users,username',
            'name'             => 'required|string|min:3|max:50',
            'email'            => 'required|string|email|unique:users,email',
            'phone'            => 'required|string|digits:11|unique:users,phone',
            'referral'         => 'nullable|string|max:50',
            'heard_about_us'   => 'nullable|string|max:100',
            'country'          => 'required|string|max:100',
            'password'         => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/'
            ],
            'confirm_password' => 'required|string|same:password|min:8',
        ];
    }

    /**
     * Custom validation messages
     */
    public function messages()
    {
        return [
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
        ];
    }
}
