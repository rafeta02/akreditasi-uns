<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAjuansTable extends Migration
{
    public function up()
    {
        Schema::create('ajuans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('tgl_ajuan')->nullable();
            $table->date('tgl_diterima')->nullable();
            $table->string('status_ajuan')->nullable();
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
