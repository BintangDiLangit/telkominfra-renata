<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kategoriLowongan()
    {
        return $this->belongsTo(KategoriLowongan::class, 'kategori_lowongans');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'companies');
    }
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class, 'lamarans');
    }
    public function lowonganFavorits()
    {
        return $this->hasMany(UserLowonganFavorit::class);
    }
}