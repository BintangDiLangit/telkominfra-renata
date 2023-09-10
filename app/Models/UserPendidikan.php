<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPendidikan extends Model
{
    use HasFactory;
    protected $guarded;


    public function organisasis()
    {
        return $this->hasMany(UserPendidikanOrganisasi::class);
    }
    public function prestasis()
    {
        return $this->hasMany(UserPendidikanPrestasi::class);
    }
}
