<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $cat = new \App\Models\Categoria(['categoria' => 'Geral']);
        $cat->save();

        $prod = new \App\Models\Produto(['nome' => 'Produto 1', 'valor' => 10,'foto' => 'assets/img/product01.png', 'descricao' => '', 'categoria_id'=> $cat->id]);
        $prod->save();

        $prod2 = new \App\Models\Produto(['nome' => 'Produto 2', 'valor' => 10,'foto' => 'assets/img/product02.png', 'descricao' => '', 'categoria_id'=> $cat->id]);
        $prod2->save();

        $prod3 = new \App\Models\Produto(['nome' => 'Produto 3', 'valor' => 10,'foto' => 'assets/img/product03.png', 'descricao' => '', 'categoria_id'=> $cat->id]);
        $prod3->save();

        $prod4 = new \App\Models\Produto(['nome' => 'Produto 4', 'valor' => 10,'foto' => 'assets/img/product04.png', 'descricao' => '', 'categoria_id'=> $cat->id]);
        $prod4->save();

        $prod5 = new \App\Models\Produto(['nome' => 'Produto 5', 'valor' => 10,'foto' => 'assets/img/product05.png', 'descricao' => '', 'categoria_id'=> $cat->id]);
        $prod5->save();
    }
    
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
