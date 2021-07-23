<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SiswaUnlockKomikModel extends Model
{
    use SoftDeletes;

    protected $table = 'siswa_unlock_komik';

    protected $fillable = [
        'user_id',
        'komik_id'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public $incrementing = false;

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function komik() {
        return $this->belongsTo('App\Models\KomikModel', 'komik_id', 'komik_id');
    }
}
