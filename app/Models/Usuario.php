<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
class Usuario extends RModel implements Authenticatable
{
  
    protected $table = "usuarios";
    protected $fillable = ['email', 'login', 'password', 'nome'];

    public function getAuthIdentifierName(){
        return 'login';
    }
    public function getAuthIdentifier(){
        return $this->login;
    }
    public function getAuthPassword(){
        return $this->password;
    }
    public function getRememberToken(){
        
    }
    public function setRememberToken($value){
        
    }
    public function getRememberTokenName(){
        
    }
    // public function setAttribute($login){

    // }
}
  
