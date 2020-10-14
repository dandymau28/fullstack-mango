<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomikModel extends Model
{
    use SoftDeletes;

    protected $table = 'komik';
    protected $primaryKey = 'komik_id';

    protected $fillable = [
        'buku_id',
        'judul',
        'tingkat',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function alamat() {
        return $this->hasMany('App\Models\AlamatKomikModel', 'komik_id', 'komik_id');
    }

    public function materi() {
        return $this->hasMany('App\Models\MateriModel', 'komik_id', 'komik_id');
    }

    public function ujian() {
        return $this->hasOne('App\Models\UjianModel', 'komik_id', 'komik_id');
    }

    public function buku() {
        return $this->belongsTo('App\Models\BukuModel', 'buku_id', 'buku_id');
    }

    public function komentar() {
        return $this->hasMany('App\Models\KomentarModel', 'komik_id', 'komik_id');
    }
}
