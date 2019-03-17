<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @property Integer unidade_id
 */
class Idaron extends Model
{
    //
    protected $guarded = ['id'];
    public function scopeUnidade($query, $unidade_id)
    {
        return $query->where("unidade_id", $unidade_id);
    }
}
