<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VacinaTipo extends Model
{
    const AFTOSA = -1;
    const BRUCELOSE = -2;
    const CARBUNCULO = -3;
    const RAIVA = -4;

    protected $guarded = ['id'];
}
