<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Http\Requests\AnimaisRequest;
use App\Pessoa;
use Faker\Provider\DateTime;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

//use JWTAuth;

/**
 * @property Builder animal
 * @property  Pessoa pessoa
 */
class AnimaisController extends Controller
{

    /**
     * AnimaisController constructor.
     * @param Animal $animal
     */
    public function __construct(Animal $animal)
    {
        $this->pessoa = \JWTAuth::parseToken()->authenticate();
        //        new \DateTime()
//        dd($this->pessoa);

//        $this->animal = $animal->where("unidade_id", "=", $this->pessoa->unidade_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->animal->get();
        return response()->api($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param AnimaisRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnimaisRequest $request)
    {
        $request->validate();
        $uniId = $this->pessoa->unidade_id;
        $pesId = $this->pessoa->id;

        $animal = new Animal();
        $animal->fill($request->all());
        $animal->unidade_id = $uniId;
        $animal->pessoa_id = $pesId;
        $animal->save();

//        $parentesco = new Parentesco();
//        $parentesco->fill($request->only(["pai_id", "mae_id"]));
//        $parentesco->save();

        return response()->api($animal);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->animal->findOrFail($id);
        $data = ($data) ? $data : [];
        return response()->api($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param AnimaisRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnimaisRequest $request, $id)
    {
        $request->validate();
        $animal = $this->animal->findOrFail($id);
        $animal->fill($request->all());
        $animal->pessoa_id = $this->pessoa->id;
        $animal->unidade_id = $this->pessoa->unidade_id;
        $animal->update();

        return response()->api($animal);
    }

    public function grupoIdade()
    {
        dd($this->pessoa->unidade_id);
        $grupos = [
            Animal::G_0006,
            Animal::G_0612,
            Animal::G_1224,
            Animal::G_2436,
            Animal::G_3699,
        ];

        $data = [];
        $cont_total_m = 0;
        $cont_total_f = 0;
        foreach ($grupos as $codigo){
            $animais_m = Animal::unidade($this->pessoa->unidade_id)->grupoIdade($codigo)->macho()->get();
            $animais_f = Animal::unidade($this->pessoa->unidade_id)->grupoIdade($codigo)->femea()->get();

            $animais_f = $this->makeAnimais($animais_f);
            $animais_m = $this->makeAnimais($animais_m);

            $grupoRes = [
                'codigo' => $codigo,
//                'descricao' => $this->makeDescricaoGrupo($codigo),
                'total_m' => count($animais_m),
                'total_f' => count($animais_f),
                'animais_m' => $animais_m,
                'animais_f' => $animais_f,
            ];
            $data[] = $grupoRes;
            $cont_total_f += count($animais_f);
            $cont_total_m += count($animais_m);
        }
        $res =[
          "grupos" => $data,
          "total_full" => $cont_total_f + $cont_total_m,
          "total_full_f" => $cont_total_f,
          "total_full_m" => $cont_total_m
        ];
        return response()->api($res);
    }

    private function makeDescricaoGrupo($codigo)
    {
        $split = $codigo;
        return $split;
    }

    private function makeAnimais($animais)
    {
        $animaisTemp = [];
        foreach ($animais as $animal){
            $animaisTemp[] =[
                "animal_id" => $animal->id,
                "nascimento" => $animal->nascimento
            ];
        }
        return $animaisTemp;
    }

}
