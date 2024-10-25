<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Endereco;
use App\Services\ClienteService;


class ClienteController extends Controller
{
    public function cadastrar(Request $request)
    {
        $data = [];
 
        return view('site/cadastrar', $data);
    }
    public function cadastrarCliente(Request $request){
        //pega todos os valores do usuario 
        $values = $request->all();
        $usuario = new Usuario();
        //$usuario->cpf =$request->input("cpf","");
        $usuario->fill($values);
        $usuario->login = $request->input("cpf","");

        $senha = $request->input("password","");
        $usuario->password = \Hash::make($senha); //criptografia
        $endereco = new Endereco($values);
        $endereco ->logradouro = $request->input("endereco","");
        
        $clienteService = new ClienteService();
        $result = $clienteService-> salvarUsuario($usuario, $endereco);
        
        $message = $result["message"];
        $status = $result["status"];

        //ok. cadastrado com sucesso
        //err, Usuario não pode ser cadastrado
        $request-> session()->flash($status,$message);
     
                return redirect()-> route("cadastrar");
    }
}   
