<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SoalModel extends Model
{
    use SoftDeletes;

    protected $table = 'soal';
    protected $primaryKey = 'soal_id';

    protected $fillable = [
        'ujian_id',
        'pertanyaan',
        'jawaban_benar'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function pilihan_jawaban() {
        return $this->hasMany('App\Models\PilihanJawabanModel', 'soal_id', 'soal_id');
    }

    public function ujian() {
        return $this->belongsTo('App\Models\UjianModel', 'ujian_id', 'ujian_id');
    }
}
