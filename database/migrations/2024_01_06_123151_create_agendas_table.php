<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agenda', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_dokumen');
            $table->date('tanggal_dokumen');
            $table->string('nomor_dokumen');
            $table->string('asal_dokumen');
            $table->string('perihal');
            $table->date('tanggal_kegiatan')->nullable();
            $table->string('file_path');
            $table->integer('tindak_lanjut')->nullable();
            $table->integer('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agenda');
    }
};
