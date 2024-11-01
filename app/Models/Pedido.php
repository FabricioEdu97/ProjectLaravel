<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory; // Adicione o trait HasFactory

    protected $table = "pedidos"; // Definindo a tabela
    protected $fillable = ['usuario_id', 'payment_id', 'datapedido', 'status']; // Campos preenchíveis

    // Relacionamento muitos-para-muitos com Produto
    public function produtos()
    {
        return $this->belongsToMany(Produto::class, 'itens_pedidos')->withPivot('quantidade'); // Relacionamento correto
    }

    // Caso você queira adicionar um relacionamento para o usuário
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    // Relacionamento com ItensPedido
    public function itens()
    {
        return $this->hasMany(ItensPedido::class, 'pedido_id'); // Um pedido tem muitos itens
    }
}
