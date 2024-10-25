<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UsuarioController extends Controller
{
    public function logar(Request $request){
        $data=[];
      
 
        if($request->isMethod("POST")){
            //se entrar nesse if é pq o usuario clicou no botao logar
            
            $login = $request->input("login");
            $senha = $request->input("senha");

            $credential = ['login' => $login, 'password'=> $senha];
            //logar
            if(Auth::attempt($credential)){
                return redirect()->route("home");
            }else{
                $request->session()->flash("err", "Usuario / senha invalido");
                return redirect()->route("logar");
            }
        }

        return view("site/logar", $data);
    }
    public function sair(Request $request){
        //LOGOUT
        Auth::logout();
        return redirect()->route("home");
    }
}
