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
        Schema::create('pertandingan_klubs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('klub_id')->unsigned()->index()->nullable();
            $table->bigInteger('pertandingan_id')->unsigned()->index()->nullable();
            $table->integer('gol')->default(0);
            $table->integer('bobol')->default(0);
            $table->enum('status', ['menang', 'kalah', 'seri']);
            $table->timestamps();
        });

        Schema::table('pertandingan_klubs', function (Blueprint $table) {
            $table->foreign('klub_id')->references('id')->on('klubs')->onDelete('cascade');
            $table->foreign('pertandingan_id')->references('id')->on('pertandingans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pertandingan_klubs');
    }
};
