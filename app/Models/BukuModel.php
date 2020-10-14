<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BukuModel extends Model
{
    use SoftDeletes;

    protected $table = 'buku';
    protected $primaryKey = 'buku_id';

    protected $fillable = [
        'judul',
        'tingkat',
        'sampul'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function komik() {
        return $this->hasMany('App\Models\KomikModel', 'buku_id', 'buku_id');
    }
}
