<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ngo extends Model
{
  use HasApiTokens, HasFactory, Notifiable;
    protected $fillable=[
      'name','email','location','beneficiaries','phonenumber','licenseNo'

    ];
    protected $hidden=[
      'licenseNo'
    ];
    public function requests(){
      return  $this->HasMany(requests::class);
    }
}
