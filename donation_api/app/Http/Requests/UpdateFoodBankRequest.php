<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFoodBankRequest extends FormRequest
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
          'cereals'=>['sometimes','integer','min:0'],
          'proteins'=>['sometimes','integer','min:0'],
          'legumes'=>['sometimes','integer','min:0'],
          'breakfast'=>['sometimes','integer','min:0'],
          'snacks'=>['sometimes','integer','min:0'],
          'cash'=>['required','integer','min:0'],
        ];
    }
}
