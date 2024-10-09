<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToAkreditasisTable extends Migration
{
    public function up()
    {
        Schema::table('akreditasis', function (Blueprint $table) {
            $table->unsignedBigInteger('fakultas_id')->nullable();
            $table->foreign('fakultas_id', 'fakultas_fk_10169896')->references('id')->on('faculties');
            $table->unsignedBigInteger('prodi_id')->nullable();
            $table->foreign('prodi_id', 'prodi_fk_10168562')->references('id')->on('prodis');
            $table->unsignedBigInteger('jenjang_id')->nullable();
            $table->foreign('jenjang_id', 'jenjang_fk_10168563')->references('id')->on('jenjangs');
            $table->unsignedBigInteger('lembaga_id')->nullable();
            $table->foreign('lembaga_id', 'lembaga_fk_10168564')->references('id')->on('lembaga_akreditasis');
        });
    }
}
