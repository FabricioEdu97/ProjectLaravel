<?php

namespace App\Services;

use App\Models\Usuario;
use App\Models\Endereco;
use Log;

class ClienteService {
    public function salvarUsuario(Usuario $user, Endereco $endereco){
        try{
            //buscando um usuario se o login ja existe
            $dbUsuario = Usuario::where("login",$user->login)->first();
            if($dbUsuario){
                return['status'=> 'err','message'=>'login ja cadastrado no sistema'];
            }
            \DB::beginTransaction();
            $user->save();
            $endereco->usuario_id = $user->id;
            $endereco->save();
            \DB::commit();

            return['status' => 'ok','message' => 'Usuario cadastrado com sucesso'];
        }catch(\Exception $e){
            //tratar o erro
            \Log::error("ERRO", ['file'=>'ClienteService.salvarUsuario','message'=>$e->getMessage()]);
            \DB::rollback();

            return['status' => 'err','message' => 'Não pode cadastrar um usuario'];
        }
    }
}
