<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('prod_nome');
            $table->string('prod_obs')->nullable();
            $table->bigInteger('prod_qtd')-> default(0);
            $table->integer('prod_unidade');
            $table->boolean('prod_ativo')-> default(1);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produtos');
    }
};
