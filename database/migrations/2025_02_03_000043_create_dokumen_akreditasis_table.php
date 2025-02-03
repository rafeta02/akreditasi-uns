<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenAkreditasisTable extends Migration
{
    public function up()
    {
        Schema::create('dokumen_akreditasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('type')->nullable();
            $table->string('note')->nullable();
            $table->integer('counter')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
