<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function dataDiri()
    {
        return $this->hasOne(UserDataDiri::class);
    }

    public function dataDiriSosmed()
    {
        return $this->hasOne(UserDataDiriSosmed::class);
    }

    public function keluargas()
    {
        return $this->hasMany(UserKeluarga::class);
    }

    public function kontakDarurats()
    {
        return $this->hasMany(UserKontakDarurat::class);
    }

    public function pendidikans()
    {
        return $this->hasMany(UserPendidikan::class);
    }

    public function pendidikanOrganisasis()
    {
        return $this->hasMany(UserPendidikanOrganisasi::class);
    }

    public function pendidikanPrestasis()
    {
        return $this->hasMany(UserPendidikanPrestasi::class);
    }

    public function riwayatPekerjaans()
    {
        return $this->hasMany(RiwayatPekerjaan::class);
    }

    public function dokumens()
    {
        return $this->hasOne(Dokumen::class);
    }
}