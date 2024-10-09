<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAjuansTable extends Migration
{
    public function up()
    {
        Schema::table('ajuans', function (Blueprint $table) {
            $table->unsignedBigInteger('fakultas_id')->nullable();
            $table->foreign('fakultas_id', 'fakultas_fk_10169807')->references('id')->on('faculties');
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->foreign('prodi_id', 'prodi_fk_10169808')->references('id')->on('prodis');
            $table->unsignedBigInteger('jenjang_id')->nullable();
            $table->foreign('jenjang_id', 'jenjang_fk_10169809')->references('id')->on('jenjangs');
            $table->unsignedBigInteger('lembaga_id')->nullable();
            $table->foreign('lembaga_id', 'lembaga_fk_10169810')->references('id')->on('lembaga_akreditasis');
        });
    }
}
