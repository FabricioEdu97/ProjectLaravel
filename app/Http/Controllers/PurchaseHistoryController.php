<?php
namespace App\Http\Controllers;

use App\Models\ItensPedido;
use Illuminate\Support\Facades\Auth;

class PurchaseHistoryController extends Controller
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
}
