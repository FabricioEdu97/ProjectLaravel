<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminCategoriaController extends Controller
{
    public function listarCategorias()
    {
        $categorias = Categoria::all();
        return view('admin.categoria.categoria_admin', compact('categorias'));
    }

    // Adicionar nova categoria
    public function adicionarCategoria(Request $request)
    {
        $request->validate([
            'categoria' => 'required|string|max:255'
        ]);

        $categoria = new Categoria();
        $categoria->categoria = $request->input('categoria');
        $categoria->save();

        return redirect()->route('admin.categoria_admin')->with('success', 'Categoria adicionada com sucesso!');
    }

    // Formulário de edição de categoria
    public function editarCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categoria.editar_categoria', compact('categoria'));
    }

    // Salvar alterações na categoria
    public function salvarEdicao(Request $request, $id)
    {
        $request->validate([
            'categoria' => 'required|string|max:255'
        ]);

        $categoria = Categoria::findOrFail($id);
        $categoria->categoria = $request->input('categoria');
        $categoria->save();

        // Redirecionar após salvar a edição
        return redirect()->route('admin.categoria_admin')->with('success', 'Categoria atualizada com sucesso!');
    }

    // Excluir uma categoria
    public function excluirCategoria($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        // Redirecionar após excluir a categoria
        return redirect()->route('admin.categoria_admin')->with('success', 'Categoria excluída com sucesso!');
    }

    public function index() { return view('admin.index'); }

}
