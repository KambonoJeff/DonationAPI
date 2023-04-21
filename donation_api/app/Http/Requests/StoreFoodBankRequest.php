<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFoodBankRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
          'cereals'=>['required','integer','min:0'],
          'proteins'=>['integer','min:0'],
          'legumes'=>['integer','min:0'],
          'breakfast'=>['integer','min:0'],
          'snacks'=>['integer','min:0'],
          'cash'=>['integer','min:0'],
        ];
    }
}
