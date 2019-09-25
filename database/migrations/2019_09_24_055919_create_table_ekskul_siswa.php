<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEkskulSiswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ekskul_siswa', function (Blueprint $table) {
            $table->integer('id_siswa')->unsigned()->index();
            $table->integer('id_ekskul')->unsigned()->index();
            $table->timestamps();

            // Set PK
            $table->primary(['id_siswa', 'id_ekskul']);

            // Set FK ekskul_siswa --- siswa
            $table->foreign('id_siswa')
                  ->references('id')
                  ->on('siswa')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
            
            // Set FK ekskul_siswa --- ekskul
            $table->foreign('id_ekskul')
                  ->references('id')
                  ->on('ekskul')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');w
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ekskul_siswa');
    }
}
