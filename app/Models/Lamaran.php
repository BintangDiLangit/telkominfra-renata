<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function lowongan()
    {
        return $this->belongsTo(Lowongan::class, 'lowongan_id');
    }

    public function milestone()
    {
        return $this->belongsTo(MasterMilestone::class, 'milestone_id');
    }

    public function keahlian()
    {
        return $this->belongsTo(MasterKeahlian::class, 'keahlian_id');
    }

    public function milestoneLamaran()
    {
        return $this->hasMany(MilestoneLamaran::class);
    }
}