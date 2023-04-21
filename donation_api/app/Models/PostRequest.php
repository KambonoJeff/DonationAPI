<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasRelationships;

class PostRequest extends Model
{
    use HasFactory;
    protected $fillable=[
      'user_id','typeoffood','quantity','beneficiaries','location',
      'status'
    ];
    public function ngo(){
      return $this->belongsTo(Ngo::class);
    }
}
