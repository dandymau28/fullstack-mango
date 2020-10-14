<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UjianModel extends Model
{
    use SoftDeletes;

    protected $table = 'ujian';
    protected $primaryKey = 'ujian_id';

    protected $fillable = [
        'komik_id',
        'waktu_ujian',
        'durasi_ujian'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function soal() {
        return $this->hasMany('App\Models\SoalModel', 'ujian_id', 'ujian_id');
    }

    public function nilai() {
        return $this->hasMany('App\Models\NilaiModel', 'ujian_id', 'ujian_id');
    }

    public function komik() {
        return $this->belongsTo('App\Models\KomikModel', 'komik_id', 'komik_id');
    }

    public function status_user() {
        return $this->hasMany('App\Models\UserUjianStatusModel', 'ujian_id', 'ujian_id');
    }
}
