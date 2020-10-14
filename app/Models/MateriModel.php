<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MateriModel extends Model
{
    use SoftDeletes;

    protected $table = 'materi';
    protected $primaryKey = 'materi_id';

    protected $fillable = [
        'komik_id',
        'judul',
        'isi'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function komik() {
        return $this->belongsTo('App\Models\KomikModel', 'komik_id', 'komik_id');
    }
}
