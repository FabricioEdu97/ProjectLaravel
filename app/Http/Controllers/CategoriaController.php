<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    //listagem inicial das categorias
    public function index()
    {
        $cat = Categoria::all();
        return view("categoria.index", compact('cat'));
    }

    //formulario de criação de categoria
    public function form_novo()
    {}

    //Salvar nova categoria
    public function salvar_novo()
    {}

    //formulario de edição de categoria
    public function form_editar()
    {}

    //Salvar edição
    public function salvar_edit()
    {}

    //excluir uma categoria
    public function exluir()
    {}
}
