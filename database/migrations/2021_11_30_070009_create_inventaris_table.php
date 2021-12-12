<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventaris', function (Blueprint $table) {
            $table->id('id_inventaris');
            $table->string('nama', 100);
            $table->string('kondisi', 50);
            $table->text('keterangan');
            $table->integer('jumlah');
            $table->unsignedBigInteger('id_jenis');
            $table->date('tanggal_register');
            $table->unsignedBigInteger('id_ruang');
            $table->char('kode_inventaris', 12);
            $table->unsignedBigInteger('id_petugas');
            $table->foreign('id_jenis')->references('id_jenis')->on('jenis');
            $table->foreign('id_ruang')->references('id_ruang')->on('ruang');
            $table->foreign('id_petugas')->references('id')->on('petugas');
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
        Schema::dropIfExists('inventaris');
    }
}
