<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAkreditasiInternasionalsTable extends Migration
{
    public function up()
    {
        Schema::table('akreditasi_internasionals', function (Blueprint $table) {
            $table->unsignedBigInteger('fakultas_id')->nullable();
            $table->foreign('fakultas_id', 'fakultas_fk_10174746')->references('id')->on('faculties');
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->foreign('prodi_id', 'prodi_fk_10174747')->references('id')->on('prodis');
            $table->unsignedBigInteger('jenjang_id')->nullable();
            $table->foreign('jenjang_id', 'jenjang_fk_10174748')->references('id')->on('jenjangs');
            $table->unsignedBigInteger('lembaga_id')->nullable();
            $table->foreign('lembaga_id', 'lembaga_fk_10174749')->references('id')->on('lembaga_akreditasis');
        });
    }
}
