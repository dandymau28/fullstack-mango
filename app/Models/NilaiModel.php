<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NilaiModel extends Model
{
    use SoftDeletes;

    protected $table = 'nilai';
    protected $primaryKey = 'nilai_id';

    protected $fillable = [
        'user_id',
        'ujian_id',
        'nilai_angka'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function ujian() {
        return $this->belongsTo('App\Models\UjianModel', 'ujian_id', 'ujian_id');
    }
}
