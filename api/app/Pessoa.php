<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Pessoa extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;
//    protected $fillable = [
//        'unidade_id',
//        'nomerazao',
//        'cpfCnpj',
//        'email1',
//        'email2',
//        'telefone1',
//        'telefone2'
//        ];
      protected $guarded = ['id'];
}
