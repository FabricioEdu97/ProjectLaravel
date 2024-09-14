<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';

    public function produtos()
    {
        //traz todos os produtos vinculados a categoria
        return $this->hesMany(Produto::class);

    }
}
