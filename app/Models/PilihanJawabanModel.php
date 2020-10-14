<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PilihanJawabanModel extends Model
{
    use SoftDeletes;

    protected $table = 'pilihan_jawaban';
    protected $primaryKey = 'pilihan_jawaban_id';

    protected $fillable = [
        'soal_id',
        'jawaban'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function soal() {
        return $this->belongsTo('App\Models\SoalModel', 'soal_id', 'soal_id');
    }
}
