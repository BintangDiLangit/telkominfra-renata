<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDataDiri extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function sosmeds()
    {
        return $this->hasMany(UserDataDiriSosmed::class);
    }
}