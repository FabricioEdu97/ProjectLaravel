<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminUsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('admin.usuarios.create'); // Crie a view create.blade.php
    }

    public function store(Request $request)
    {
        // Validação e criação do usuário
        $usuario = Usuario::create($request->all());
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('admin.usuarios.edit', compact('usuario')); // Crie a view edit.blade.php
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        // Validação dos campos
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:usuarios,login,' . $usuario->id,
            'email' => 'required|string|email|max:255|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:3', // A senha é opcional
        ]);

        // Atualizando o usuário
        if ($request->filled('password')) {
            // Se a senha foi fornecida, hash e atualizar
            $data['password'] = bcrypt($request->password);
        } else {
            // Caso contrário, removemos a senha do array de dados
            unset($data['password']);
        }

        $usuario->update($data);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }


    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuário excluído com sucesso!');
    }
}
