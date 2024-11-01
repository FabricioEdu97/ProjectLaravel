<?php

namespace App\Http\Controllers;

use App\Models\ItensPedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function confirmarCompra($pedido_id)
    {
        // Busca os itens do pedido
        $itens = ItensPedido::with('produto')->where('pedido_id', $pedido_id)->get();

        return view('pedido.confirmacao', compact('itens'));
    }
}
