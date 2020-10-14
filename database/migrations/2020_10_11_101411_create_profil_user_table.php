<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profil_user', function (Blueprint $table) {
            $table->bigIncrements('profil_id');
            $table->foreignId('user_id')->references('user_id')->on('users');
            $table->enum('kelas', ['10', '11', '12'])->nullable();
            $table->string('nama')->nullable();
            $table->string('nomor_hp', 15)->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profil_user');
    }
}
