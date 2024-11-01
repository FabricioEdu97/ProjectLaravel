<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;
use App\Services\VendaService;
use App\Http\Controllers\AdminProdutoController;

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

        //select * from categoria
        $listaCategorias = Categoria::all();
        //select * from produtos limit 4
        $queryProduto = Produto::limit(1100);

        if ($idcategoria != 0) {
            //where categoria_id = $idcategoria
            $queryProduto->where("categoria_id", $idcategoria);
        }

        $listaProdutos = $queryProduto->get();

        $data["lista"] = $listaProdutos;
        $data["listaCategoria"] = $listaCategorias;
        $data["idcategoria"] = $idcategoria;
        return view("site/categoria", $data);
    }

    public function adicionarCarrinho($idProduto = 0, Request $request)
    {
        //buscar o produto por id
        $prod = Produto::find($idProduto);

        if ($prod) {
            //encontrou um produto

            //buscar da sessão o carrinho atual
            $carrinho = session('cart', []);

            array_push($carrinho, $prod);
            session(['cart' => $carrinho]);
        }
        return redirect()->route("categoria");
    }

    public function verCarrinho(Request $request)
    {
        $carrinho = session('cart', []);
        $data = ['cart' => $carrinho];

        return view("site/carrinho", $data);
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

        $prods = session('cart', []);
        $vendaService = new vendaService();
        $result = $vendaService->finalizarVenda($prods, \Auth::user());

        if ($result["status"] == "ok") {
            $request->session()->forget("cart");
        }

        $request->session()->flash($result["status"], $result["message"]);
        return redirect()->route("ver_carrinho");
    }
}
