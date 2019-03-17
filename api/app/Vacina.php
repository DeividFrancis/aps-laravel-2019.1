<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vacina extends Model
{
    const AFTOSA = -1;
    const BRUCELOSE = -2;
    const CARBUNCULO = -3;
    const RAIVA = -4;
    protected $guarded = ['id'];

    public function animal(){
        return $this->belongsTo(Animal::class);
    }

    public function vacinatipos(){
        return $this->belongsTo(VacinaTipo::class);
    }
}
