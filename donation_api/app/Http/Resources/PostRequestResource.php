<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostRequestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
          'id'=>$this->id,
          'attributes'=>[
            'user_id'=>$this->user_id,
            'typeoffood'=>$this->typeoffood,
            'quantity'=>$this->quantity,
            'beneficiaries'=>$this->beneficiaries,
            'location'=>$this->location,
            'status'=>$this->status,
          ],
        ];
    }
}
