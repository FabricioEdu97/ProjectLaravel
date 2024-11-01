<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use App\Models\ItensPedido; // Certifique-se de que este modelo está importado
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Importa o Auth

class HistoricoComprasController extends Controller
{
    public function index() // Renomeie o método para index ou algo apropriado
    {
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para ver seu histórico de compras.');
        }

        // Pega o id do usuário autenticado
        $usuarioId = Auth::id();

        // Busca os itens comprados pelo usuário
        $itensComprados = ItensPedido::whereHas('pedido', function ($query) use ($usuarioId) {
            $query->where('usuario_id', $usuarioId);
        })->with('produto')->get();

        return view('historico_compras', ['itens' => $itensComprados]);
    }
}
