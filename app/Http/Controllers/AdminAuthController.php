<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // Retorna a view de login do admin
    }

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Tenta autenticar com o guard 'admin'
    if (Auth::guard('admin')->attempt($credentials)) {
        // Redireciona para a dashboard do admin após login bem-sucedido
        return redirect()->route('index'); // 'index' é a rota para o dashboard
    }

    // Se falhar, armazena uma mensagem de erro na sessão
    return back()->withErrors([
        'email' => 'As credenciais fornecidas estão incorretas.',
    ])->withInput(); // Retorna com erro e mantém os dados de entrada
}


    public function logout()
    {
        // Faz logout do admin
        Auth::guard('admin')->logout();
        // Redireciona para a página de login do admin
        return redirect('/admin/login');
    }
}
