<?php

namespace App\Services;
use Log;
use App\Models\Usuario;
use App\Models\Pedido;
use App\Models\ItensPedido;

    class VendaService{

        public function finalizarVenda($prods=[], Usuario $user){

            try{

                \DB::beginTransaction();
                $dthoje = new \DateTime();
                $pedido = new Pedido();

                $pedido->datapedido = $dthoje->format("Y-m-d H:i:s");
                $pedido->status ="PEN";
                $pedido->usuario_id = $user->id;
                
                $pedido->save();

                foreach($prods as $p){
                    $itens = new ItensPedido();

                    $itens->quantidade =1;
                    $itens->valor =$p->valor;
                    $itens->dt_item = $dthoje->format("Y-m-d H:i:s"); 
                    $itens->produto_id =$p->id;
                    $itens->pedido_id =$pedido->id;

                    $itens->save();
                }
              

                \DB::commit();
                return ['status'=> 'ok', 'message' => 'venda finalizada com sucesso'];
            }catch(\Exception $e){
                \DB::rollback();
                Log::error("erro:Venda service",['message'=> $e->getMessage()]);
                return ['status'=> 'err', 'message' => 'venda não pode ser finalizada'];
            }
        }
    }