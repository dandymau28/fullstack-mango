<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKomikTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('komik', function (Blueprint $table) {
            $table->bigIncrements('komik_id');
            $table->foreignId('buku_id')->references('buku_id')->on('buku');
            $table->string('judul');
            $table->string('tingkat');
            $table->enum('status',['terbit','belum_terbit'])->default('belum_terbit');
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
        Schema::dropIfExists('komik');
    }
}
