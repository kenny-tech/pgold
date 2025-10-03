<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CalculateRateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Already restricted by auth middleware
    }

    public function rules(): array
    {
        return [
            'type'   => 'required|in:crypto,giftcard',
            'asset'  => 'required|string',
            'amount' => 'required|numeric|min:0.01',
        ];
    }
}
