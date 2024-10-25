<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;
use App\Services\VendaService;

class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $data = [];

        //buscar todos os produtos
        //select * from produtos
        $listaProdutos = Produto::all();
        $data["lista"] = $listaProdutos;

        return view('web.home', $data);
    }


    public function categoria($idcategoria = 0,Request $request)
    {
        $data = [];

        //select * from categoria
        $listaCategorias = Categoria::all();
        //select * from produtos limit 4
        $queryProduto = Produto::limit(5);

        if($idcategoria != 0){
            //where categoria_id = $idcategoria
                $queryProduto->where("categoria_id", $idcategoria);
        }

        $listaProdutos = $queryProduto->get();

        $data["lista"] = $listaProdutos;
        $data["listaCategoria"] = $listaCategorias;
        $data["idcategoria"] = $idcategoria;
        return view("site/categoria", $data);
    }

    public function adicionarCarrinho($idProduto = 0, Request $request){
        //buscar o produto por id
        $prod = Produto::find($idProduto);
        
        if($prod){
            //encontrou um produto

            //buscar da sessão o carrinho atual
            $carrinho = session('cart',[]);

            array_push($carrinho, $prod);
            session([ 'cart'=> $carrinho]);
        }
        return redirect()->route("home");
    }

    public function verCarrinho(Request $request){
        $carrinho = session('cart',[]);
        $data = ['cart'=>$carrinho];

        return view("site/carrinho", $data);
    }

    public function excluirCarrinho($indice, Request $request){
        $carrinho = session('cart',[]);
        if(isset($carrinho[$indice])){
            unset($carrinho[$indice]);
        }
        session(["cart"=> $carrinho]);
        return redirect()->route ("ver_carrinho");
    }

    public function finalizar(Request $request){

        $prods = session('cart',[]);
        $vendaService = new vendaService();
        $result = $vendaService->finalizarVenda($prods, \Auth::user());

        if($result["status"] == "ok"){
            $request->session()->forget("cart");
        }

        $request->session()->flash($result["status"], $result["message"]);
        return redirect()->route ("ver_carrinho");
    }
}