<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlamatKomikModel extends Model
{
    use SoftDeletes;

    protected $table = 'alamat_komik';
    protected $primaryKey = 'alamat_komik_id';

    protected $fillable = [
        'komik_id',
        'alamat'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function komik() {
        return $this->belongsTo('App\Models\KomikModel', 'komik_id', 'komik_id');
    }

    public function materi() {
        return $this->hasOne('App\Models\MateriModel', 'alamat_komik_id', 'alamat_komik_id');
    }
}
