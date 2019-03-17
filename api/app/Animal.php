<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class Animal extends Model
{
    const  G_0006 = "00-06";
    const  G_0612 = "06-12";
    const  G_1224 = "12-24";
    const  G_2436 = "24-36";
    const  G_3699 = "36-99";


    protected $table = "animais";
    protected $guarded = ['id'];

    public function vacinas()
    {
        return $this->hasMany(Vacina::class);
    }

    public function scopeUnidade($query, $uni_id)
    {
        return $query->where("unidade_id", $uni_id);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeMacho($query)
    {
        return $query->where("sexo", "M");
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeFemea($query)
    {
        return $query->where("sexo", "F");
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeGrupoIdade($query, $grupo)
    {
        switch ($grupo) {
            case(self::G_0006):
                $data_atual = new \DateTime();
                $data_atual->modify("-6 month");
                return $query->where("nascimento", ">=", $data_atual->format("Y-m-d"));
                break;
            case(self::G_0612):
                $data_06 = new \DateTime();
                $data_06->modify("-6 month");

                $data_12 = new \DateTime();
                $data_12->modify("-12 month");
                return $query->where("nascimento", ">=", $data_12->format("Y-m-d"))
                    ->where('nascimento', "<=", $data_06->format("Y-m-d"));
                break;
            case(self::G_1224):
                $data_12 = new \DateTime();
                $data_12->modify("-12 month");

                $data_24 = new \DateTime();
                $data_24->modify("-24 month");
                return $query->where("nascimento", ">=", $data_24->format("Y-m-d"))
                    ->where('nascimento', "<=", $data_12->format("Y-m-d"));
                break;
            case(self::G_2436):
                $data_24 = new \DateTime();
                $data_24->modify("-24 month");

                $data_36 = new \DateTime();
                $data_36->modify("-36 month");
                return $query->where("nascimento", ">=", $data_36->format("Y-m-d"))
                    ->where('nascimento', "<=", $data_24->format("Y-m-d"));
                break;
            case(self::G_3699):
                $data_36 = new \DateTime();
                $data_36->modify("-36 month");
                return $query->where('nascimento', "<=", $data_36->format("Y-m-d"));
                break;
        }
    }
}
