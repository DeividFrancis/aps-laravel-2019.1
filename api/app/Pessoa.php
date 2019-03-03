<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $fillable = ['unidade_id', 'nomerazao', 'cpfCnpj'];
}
