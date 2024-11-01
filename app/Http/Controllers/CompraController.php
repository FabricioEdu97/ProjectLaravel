<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItensPedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompraController extends Controller
{
    public function historicoCompras()
    {
        // Verifique se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('logar')->with('error', 'Você precisa estar logado para ver o histórico de compras.');
        }

        // Obtenha o ID do usuário autenticado
        $usuarioId = Auth::id();

        // Busque os itens do histórico de compras do usuário
        $itensComprados = ItensPedido::whereHas('pedido', function($query) use ($usuarioId) {
            $query->where('usuario_id', $usuarioId);
        })->with('produto')->get();

        // Retorne a view com os itens comprados
        return view('historico_compras', ['itensComprados' => $itensComprados]);
    }

    public function processarCompra(Request $request)
{
    // Validação dos dados do pedido
    $request->validate([
        'produtos' => 'required|array',
        'produtos.*.id' => 'required|exists:produtos,id',
        'produtos.*.quantidade' => 'required|integer|min:1',
    ]);

    // Criação do pedido
    $pedido = new Pedido();
    $pedido->usuario_id = Auth::id(); // Salvar o ID do usuário autenticado
    $pedido->datapedido = now(); // Defina a data do pedido
    // Adicione outros campos necessários
    $pedido->save();

    // Criação dos itens do pedido
    foreach ($request->produtos as $produto) {
        $itemPedido = new ItensPedido();
        $itemPedido->pedido_id = $pedido->id; // Referenciar o ID do pedido
        $itemPedido->produto_id = $produto['id']; // ID do produto
        $itemPedido->quantidade = $produto['quantidade']; // Quantidade comprada
        // Adicione outros campos necessários
        $itemPedido->save();
    }

    return redirect()->route('historico_compras')->with('success', 'Compra realizada com sucesso!');
}

}
