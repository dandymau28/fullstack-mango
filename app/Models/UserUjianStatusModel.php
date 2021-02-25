<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserUjianStatusModel extends Model
{
    use SoftDeletes;

    protected $table = 'user_ujian_status';

    protected $fillable = [
        'user_id',
        'ujian_id',
        'status'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public $incrementing = false;

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function ujian() {
        return $this->belongsTo('App\Models\UjianModel', 'ujian_id', 'ujian_id');
    }
}
