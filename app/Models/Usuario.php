<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;

class Usuario extends RModel implements Authenticatable
{
    protected $table = "usuarios";
    protected $fillable = ['email', 'login', 'password', 'nome'];

    public function getAuthIdentifierName()
    {
        return 'login';
    }

    public function getAuthIdentifier()
    {
        return $this->login;
    }

    public function getAuthPassword()
    {
        return $this->password;
    }

    public function getRememberToken()
    {
        return null; // Retorna null se não houver um token de lembrete
    }

    public function setRememberToken($value)
    {
        // Lógica para definir um token de lembrete se necessário
    }

    public function getRememberTokenName()
    {
        return null; // Retorna null se não houver um token de lembrete
    }
}
