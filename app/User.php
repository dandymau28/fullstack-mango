<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function komentar()
    {
        return $this->hasMany('App\Models\KomentarModel', 'user_id', 'user_id');
    }

    public function nilai()
    {
        return $this->hasMany('App\Models\NilaiModel', 'user_id', 'user_id');
    }

    public function status_ujian()
    {
        return $this->hasMany('App\Models\UserUjianStatusModel', 'user_id', 'user_id');
    }

    public function profil() {
        return $this->hasOne('App\Models\ProfilUserModel', 'user_id', 'user_id');
    }

    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    // public function getJWTIdentifier()
    // {
    //     return $this->getKey();
    // }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    // public function getJWTCustomClaims()
    // {
    //     return [];
    // }
}
