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
        Schema::create('disposisi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agenda_id');
            $table->integer('disposisi');
            $table->string('catatan')->nullable();
            $table->string('laporan')->nullable();
            $table->integer('dp2')->nullable();
            $table->integer('dp3')->nullable();
            $table->integer('dp4')->nullable();
            $table->integer('dp5')->nullable();
            $table->integer('selesaikan')->default(0);

            $table->foreign('agenda_id')->references('id')->on('agenda')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('disposisi');
    }
};
