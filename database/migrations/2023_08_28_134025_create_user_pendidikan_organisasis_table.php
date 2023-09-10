<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserPendidikanOrganisasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_pendidikan_organisasis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('user_pendidikan_id')->nullable();
            $table->string('nama_organisasi')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('tahun_mulai')->nullable();
            $table->string('tahun_lulus')->nullable();
            $table->text('upload_bukti')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_pendidikan_organisasis');
    }
}
