<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfilUserModel extends Model
{
    use SoftDeletes;

    protected $table = 'profil_user';
    protected $primaryKey = 'profil_id';

    protected $fillable = [
        'user_id',
        'kelas',
        'nama',
        'nomor_hp'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user() {
        return $this->hasOne('App\User', 'user_id', 'user_id');
    }
}
