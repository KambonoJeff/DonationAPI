<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
      // $method = $this->method();
      // if($method == 'PUT'){

        // return [
        //   'user_id'=>['required'],
        //   'typeoffood'=>['required','string','max:255'],
        //   'quantity'=>['required','integer'],
        //   'beneficiaries'=>['required'],
        //   'location'=>['required','string'],
        //   'status'=>['required','string',Rule::in(['Approved','Pending','NotApproved'])]

        //   ];
        // }else{
          return [
            'user_id'=>['sometimes','required'],
            'typeoffood'=>['sometimes','required','string','max:255'],
            'quantity'=>['sometimes','required','integer'],
            'beneficiaries'=>['sometimes','required'],
            'location'=>['sometimes','required','string'],
            'status'=>['sometimes','required','string',Rule::in(['Approved','Pending','NotApproved'])
          ],
        ];

    }
}
