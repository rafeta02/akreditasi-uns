<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDokumenAkreditasisTable extends Migration
{
    public function up()
    {
        Schema::table('dokumen_akreditasis', function (Blueprint $table) {
            $table->unsignedBigInteger('ajuan_id')->nullable();
            $table->foreign('ajuan_id', 'ajuan_fk_10415731')->references('id')->on('ajuans');
            $table->unsignedBigInteger('owned_by_id')->nullable();
            $table->foreign('owned_by_id', 'owned_by_fk_10415736')->references('id')->on('users');
        });
    }
}
