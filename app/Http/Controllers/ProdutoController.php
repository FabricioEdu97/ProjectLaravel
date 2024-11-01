<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;
use App\Services\VendaService;
use Illuminate\Support\Facades\Auth; // Importa o Auth

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        // Obtendo os produtos mais vendidos
        $produtosMaisVendidos = $this->produtosMaisVendidos();

        return view('layout', compact('produtosMaisVendidos'));
    }

    private function produtosMaisVendidos()
    {
        // Consulta para obter os produtos mais vendidos
        return Produto::select('produtos.id', 'produtos.nome', 'produtos.valor', 'produtos.foto', 'produtos.descricao', 'produtos.categoria_id')
            ->join('itens_pedidos', 'produtos.id', '=', 'itens_pedidos.produto_id')
            ->selectRaw('SUM(itens_pedidos.quantidade) as total_vendido')
            ->groupBy('produtos.id', 'produtos.nome', 'produtos.valor', 'produtos.foto', 'produtos.descricao', 'produtos.categoria_id')
            ->orderByDesc('total_vendido')
            ->limit(5)  // Ajuste o limite conforme necessário
            ->get();
    }

    public function detalhesProduto($id)
    {
        $produto = Produto::findOrFail($id);
        return view('site.produto_detalhes', compact('produto'));
    }

    public function categoria(Request $request, $idcategoria = 0)
    {
        $data = [];
        // Obtendo todas as categorias
        $listaCategorias = Categoria::all();
        // Obtendo produtos com base na categoria
        $queryProduto = Produto::query();

        if ($idcategoria != 0) {
            // Filtra por categoria se idcategoria for diferente de 0
            $queryProduto->where("categoria_id", $idcategoria);
        }

        $listaProdutos = $queryProduto->limit(1100)->get();

        $data["lista"] = $listaProdutos;
        $data["listaCategoria"] = $listaCategorias;
        $data["idcategoria"] = $idcategoria;
        return view("site.categoria", $data);
    }

    public function adicionarCarrinho($idProduto = 0, Request $request)
    {
        // Buscar o produto por id
        $prod = Produto::find($idProduto);

        if ($prod) {
            // Buscar da sessão o carrinho atual
            $carrinho = session('cart', []);

            // Verifica se o produto já está no carrinho
            $prodIndex = array_search($idProduto, array_column($carrinho, 'id'));

            if ($prodIndex === false) {
                // Produto não está no carrinho, então adiciona
                $carrinho[] = $prod;
            }
            session(['cart' => $carrinho]);
        }
        return redirect()->route("categoria");
    }

    public function verCarrinho(Request $request)
    {
        $carrinho = session('cart', []);
        return view("site.carrinho", ['cart' => $carrinho]);
    }

    public function excluirCarrinho($indice, Request $request)
    {
        $carrinho = session('cart', []);
        if (isset($carrinho[$indice])) {
            unset($carrinho[$indice]);
        }
        session(["cart" => $carrinho]);
        return redirect()->route("ver_carrinho");
    }

    public function finalizar(Request $request)
    {
        // Verifique se o usuário está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Você precisa estar logado para finalizar a compra.');
        }

        // Obtendo os produtos do carrinho
        $prods = session('cart', []);

        // Lógica para finalizar a venda
        $vendaService = new VendaService();
        $result = $vendaService->finalizarVenda($prods, Auth::user());

        // Verifique se a venda foi bem-sucedida
        if ($result["status"] == "ok") {
            // Limpa o carrinho após a venda
            $request->session()->forget("cart"); // Remove todos os itens do carrinho

            // Atualiza a quantidade dos produtos no estoque
            foreach ($prods as $produto) {
                $produtoModel = Produto::find($produto->id);
                if ($produtoModel) {
                    $quantidadeVenda = $produto->quantidade ?? 1; // Ajuste conforme necessário
                    // Verifica se a quantidade disponível é suficiente
                    if ($produtoModel->quantidade >= $quantidadeVenda) {
                        $produtoModel->quantidade -= $quantidadeVenda;
                        $produtoModel->save();
                    } else {
                        // Aqui você pode adicionar uma lógica para lidar com estoque insuficiente, se necessário
                    }
                }
            }
        }

        // Define a mensagem de feedback para o usuário
        $request->session()->flash($result["status"], $result["message"]);

        // Redireciona para a página do carrinho
        return redirect()->route("ver_carrinho");
    }
}
