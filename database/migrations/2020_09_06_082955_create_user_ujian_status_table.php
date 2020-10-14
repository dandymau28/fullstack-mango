<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserUjianStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ujian_status', function (Blueprint $table) {
            $table->foreignId('user_id')->references('user_id')->on('users');
            $table->foreignId('ujian_id')->references('ujian_id')->on('ujian');
            $table->enum('status',['sudah_ujian','belum_ujian'])->default('belum_ujian');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
            
            $table->primary(['user_id', 'ujian_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_ujian_status');
    }
}
