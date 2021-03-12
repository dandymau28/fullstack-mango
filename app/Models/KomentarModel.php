<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KomentarModel extends Model
{
    use SoftDeletes;

    protected $table = 'komentar';
    protected $primaryKey = 'komentar_id';

    protected $fillable = [
        'user_id',
        'komik_id',
        'isi_komentar'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'user_id')->withTrashed();
    }

    public function komik() {
        return $this->belongsTo('App\Models\KomikModel', 'komik_id', 'komik_id')->withTrashed();
    }
}
