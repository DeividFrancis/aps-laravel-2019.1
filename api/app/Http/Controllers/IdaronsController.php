<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Http\Requests\IdaronsRequest;
use App\Idaron;
use App\Pessoa;

/**
 * @property Idaron $idaron
 * @property Pessoa $pessoa
 */
class IdaronsController extends Controller
{
    /**
     * IdaromControoler constructor.
     * @param Idaron $idaron
     * @internal param Idaron $idarom
     */
    public function __construct(Idaron $idaron)
    {
        $this->pessoa = \JWTAuth::parseToken()->authenticate();
        $this->idaron = $idaron;
    }

    public function index()
    {
        $idades = [
            Animal::G_0006,
            Animal::G_0612,
            Animal::G_1224,
            Animal::G_2436,
            Animal::G_3699,
        ];
        $data = $this->idaron->unidade($this->pessoa->unidade_id)->get();
        foreach ($data as $d) {
            // Soma
            $m_total = 0;
            $f_total = 0;
            foreach ($idades as $i) {
                $m_total += $d["m_".$i];
                $f_total += $d["f_".$i];
            }
            $d["m_total"] = $m_total;
            $d["f_total"] = $f_total;
            $d["total"] = $f_total + $m_total;
        }
        return response()->api($data);
    }

    public function store(IdaronsRequest $request)
    {
        $request->validated();

        $idaron = new Idaron();
        $idaron->fill($request->all());
        $idaron->unidade_id = $this->pessoa->unidade_id;
        $idaron->pessoa_digitado_id = $this->pessoa->id;
        $idaron->cadastro = new \DateTime();
        $idaron->save();

        return response()->api($idaron);
    }
}
