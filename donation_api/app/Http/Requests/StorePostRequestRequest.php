<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequestRequest extends FormRequest
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
            'user_id'=>['required'],
            'typeoffood'=>['required','string','max:255'],
            'quantity'=>['required','integer'],
            'beneficiaries'=>['required'],
            'location'=>['required','string'],
            'status'=>['required','string',Rule::in(['Approved','Pending','NotApproved'])]

        ];
    }
}
