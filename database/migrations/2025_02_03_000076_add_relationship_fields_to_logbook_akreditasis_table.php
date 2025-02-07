<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLogbookAkreditasisTable extends Migration
{
    public function up()
    {
        Schema::table('logbook_akreditasis', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_10424520')->references('id')->on('users');
            $table->unsignedBigInteger('uraian_id')->nullable();
            $table->foreign('uraian_id', 'uraian_fk_10431220')->references('id')->on('uraian_logbooks');
            $table->unsignedBigInteger('validated_by_id')->nullable();
            $table->foreign('validated_by_id', 'validated_by_fk_10427284')->references('id')->on('users');
        });
    }
}
