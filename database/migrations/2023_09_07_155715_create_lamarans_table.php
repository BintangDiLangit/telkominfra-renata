<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLamaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamarans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('lowongan_id');
            $table->string('ekspektasi_gaji');
            $table->string('tanggal_kesiapan_bergabung');
            $table->text('benefit');
            $table->string('milestone_id')->default(1);
            $table->string('status')->default("PASSED");
            $table->string('remark')->nullable();

            $table->string('profile_photo')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->string('tanggal_lahir')->nullable();
            $table->bigInteger('keahlian_id')->nullable();
            $table->bigInteger('jabatan_id')->nullable();
            $table->text('alamat_lengkap')->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->json('sosmeds')->nullable();

            $table->json('keluargas')->nullable();
            $table->json('kontak_darurats')->nullable();
            $table->json('pendidikans')->nullable();
            $table->json('pendidikan_organisasis')->nullable();
            $table->json('pendidikan_prestasis')->nullable();
            $table->json('riwayat_pekerjaans')->nullable();
            $table->json('dokumens')->nullable();
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
        Schema::dropIfExists('lamarans');
    }
}