<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdisTable extends Migration
{
    public function up()
    {
        Schema::create('prodis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code');
            $table->string('slug')->nullable();
            $table->string('code_siakad')->nullable();
            $table->string('nim')->nullable();
            $table->string('name_dikti')->nullable();
            $table->string('name_akreditasi')->nullable();
            $table->string('name_en')->nullable();
            $table->string('gelar')->nullable();
            $table->string('gelar_en')->nullable();
            $table->date('tanggal_berdiri')->nullable();
            $table->string('sk_izin')->nullable();
            $table->date('tgl_sk_izin')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
