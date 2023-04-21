<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'userid'=>$this->id,
          'username'=>$this->user,
          'email'=>$this->email,
          'createdat'=>$this->created_at
        ];
    }
}
