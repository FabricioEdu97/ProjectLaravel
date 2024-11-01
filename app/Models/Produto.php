<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory; // Adicione o trait HasFactory

    protected $table = "produtos"; // Definindo a tabela
    protected $fillable = ['nome', 'foto', 'descricao', 'categoria_id', 'valor']; // Campos preenchíveis

    // Relacionamento com Categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id'); // Um produto pertence a uma categoria
    }

    // Relacionamento muitos-para-muitos com Pedido
    public function pedidos()
    {
        return $this->belongsToMany(Pedido::class, 'itens_pedidos')->withPivot('quantidade'); // Relacionamento correto
    }
}
