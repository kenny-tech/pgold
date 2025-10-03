<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerifyOtpRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'otp'   => 'required|digits:6',
        ];
    }

    /**
     * Custom messages
     */
    public function messages()
    {
        return [
            'email.exists' => 'We could not find a user with this email address.',
        ];
    }
}
