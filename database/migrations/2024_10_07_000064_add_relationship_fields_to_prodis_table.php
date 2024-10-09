<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProdisTable extends Migration
{
    public function up()
    {
        Schema::table('prodis', function (Blueprint $table) {
            $table->unsignedBigInteger('fakultas_id')->nullable();
            $table->foreign('fakultas_id', 'fakultas_fk_10169895')->references('id')->on('faculties');
            $table->unsignedBigInteger('jenjang_id')->nullable();
            $table->foreign('jenjang_id', 'jenjang_fk_10168514')->references('id')->on('jenjangs');
        });
    }
}
