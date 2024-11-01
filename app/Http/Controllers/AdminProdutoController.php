<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria; // Certifique-se de que este modelo está importado
use Illuminate\Http\Request;

class AdminProdutoController extends Controller
{
    // Listar todos os produtos
    public function listarProdutos()
    {
        $produtos = Produto::with('categoria')->get(); // Carregar a categoria junto com os produtos
        return view('admin.produto.produto_admin', compact('produtos'));
    }
    

    // Adicionar novo produto
    public function adicionarProduto(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'foto' => 'nullable|image|max:2048', // Exemplo para imagem
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|integer|exists:categorias,id'
        ]);

        $produto = new Produto();
        $produto->nome = $request->input('nome');
        $produto->valor = $request->input('valor');
        $produto->descricao = $request->input('descricao');
        $produto->categoria_id = $request->input('categoria_id');

        if ($request->hasFile('foto')) {
            $produto->foto = $request->file('foto')->store('produtos', 'public'); // Armazenar na pasta public
        }

        $produto->save();

        return redirect()->route('admin.produto_admin')->with('success', 'Produto adicionado com sucesso!');
    }

    // Formulário de criação de produto
   // Criar produto
public function criarProduto()
{
    $categorias = Categoria::all(); // Buscando todas as categorias
    return view('admin.produto.criar_produto', compact('categorias'));
}


    // Formulário de edição de produto
    public function editarProduto($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::all(); // Buscando todas as categorias para o dropdown
        return view('admin.produto.editar_produto', compact('produto', 'categorias'));
    }

    // Salvar alterações no produto
    public function salvarEdicao(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'valor' => 'required|numeric',
            'foto' => 'nullable|image|max:2048',
            'descricao' => 'nullable|string',
            'categoria_id' => 'required|integer|exists:categorias,id'
        ]);

        $produto = Produto::findOrFail($id);
        $produto->nome = $request->input('nome');
        $produto->valor = $request->input('valor');
        $produto->descricao = $request->input('descricao');
        $produto->categoria_id = $request->input('categoria_id');

        if ($request->hasFile('foto')) {
            $produto->foto = $request->file('foto')->store('produtos', 'public'); // Armazenar na pasta public
        }

        $produto->save();

        return redirect()->route('admin.produto_admin')->with('success', 'Produto atualizado com sucesso!');
    }

    // Excluir um produto
    public function excluirProduto($id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();

        return redirect()->route('admin.produto_admin')->with('success', 'Produto excluído com sucesso!');
    }
}
