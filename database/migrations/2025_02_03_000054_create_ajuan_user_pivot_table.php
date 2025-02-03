<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjuanUserPivotTable extends Migration
{
    public function up()
    {
        Schema::create('ajuan_user', function (Blueprint $table) {
            $table->unsignedBigInteger('ajuan_id');
            $table->foreign('ajuan_id', 'ajuan_id_fk_10424532')->references('id')->on('ajuans')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id', 'user_id_fk_10424532')->references('id')->on('users')->onDelete('cascade');
        });
    }
}
