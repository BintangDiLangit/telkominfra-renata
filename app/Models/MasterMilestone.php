<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterMilestone extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function lamarans()
    {
        return $this->hasMany(Lamaran::class, 'milestone_id');
    }
}