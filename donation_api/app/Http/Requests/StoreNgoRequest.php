<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNgoRequest extends FormRequest
{
    /**
     *
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
            'name'=>['required','string','max:255'],
            'email'=>['required','unique:Ngo','string'],
            'location'=>['required','string'],
            'beneficiaries'=>['required','integer'],
            'phonenumber'=>['required','string','max:15'],
            'licenseNo'=>['required','integer','min:6','confirmed']
        ];
    }
}
