<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAkreditasiInternasionalsTable extends Migration
{
    public function up()
    {
        Schema::create('akreditasi_internasionals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('no_sk')->nullable();
            $table->date('tgl_sk')->nullable();
            $table->date('tgl_awal_sk')->nullable();
            $table->date('tgl_akhir_sk')->nullable();
            $table->integer('tahun_expired')->nullable();
            $table->string('peringkat')->nullable();
            $table->integer('nilai')->nullable();
            $table->boolean('diakui_dikti')->default(0)->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
