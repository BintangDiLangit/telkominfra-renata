<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowongansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lowongans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('kategori_lowongans');
            $table->string('judul');
            $table->string('lokasi');
            $table->bigInteger('companies');
            $table->text('deskripsi');
            $table->text('experience');
            $table->string('range_gaji')->nullable();
            $table->string('status')->default("Aktif");
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
        Schema::dropIfExists('lowongans');
    }
}