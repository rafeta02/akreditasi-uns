<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogbookAkreditasisTable extends Migration
{
    public function up()
    {
        Schema::create('logbook_akreditasis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uraian')->nullable();
            $table->string('detail')->nullable();
            $table->date('tanggal')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('satuan')->nullable();
            $table->longText('keterangan')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
