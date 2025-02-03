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
        });
    }
}
