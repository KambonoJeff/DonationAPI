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
     * ,Rule::in(['Approved','Pending','NotApproved'])
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id'=>['required'],
            'typeoffood'=>['required','max:255'],
            'quantity'=>['required'],
            'beneficiaries'=>['required'],
            'location'=>['required'],
            'status'=>['required']

        ];
    }
}
