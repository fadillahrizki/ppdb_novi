<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataAyahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_ayahs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('formulir_id')->unsigned();
            $table->string('no_kk');
            $table->string('nama');
            $table->string('status');
            $table->string('no_kk_ayah');
            $table->date('tanggal_lahir');
            $table->string('keadaan');
            $table->string('pekerjaan');
            $table->string('pendidikan');
            $table->string('penghasilan');
            $table->timestamps();

            $table->foreign('formulir_id')->references('id')->on('formulirs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_ayahs');
    }
}
