<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItensPedido extends Model
{
    use HasFactory; // Adicione o trait HasFactory

    protected $table = "itens_pedidos"; // Definindo a tabela
    protected $fillable = ['quantidade', 'valor', 'dt_item', 'produto_id', 'pedido_id']; // Campos preenchíveis

    // Relacionamento com Produto
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'produto_id'); // Um item pertence a um produto
    }

    // Relacionamento com Pedido
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'pedido_id'); // Um item pertence a um pedido
    }
}
