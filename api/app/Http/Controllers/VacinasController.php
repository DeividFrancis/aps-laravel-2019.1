<?php

namespace App\Http\Controllers;

use App\Animal;
use App\Http\Requests\VacinasRequest;
use App\Pessoa;
use App\Vacina;
use App\VacinaTipo;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @property  Pessoa pessoa
 * @property  Builder vacina
 */
class VacinasController extends Controller
{

    /**
     * VacinasController constructor.
     */
    public function __construct(Vacina $vacina)
    {
        $this->pessoa = \JWTAuth::parseToken()->authenticate();
        $this->vacina = $vacina->where("unidade_id", "=", $this->pessoa->unidade_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->vacina->get();
        return response()->api($data);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param VacinasRequest|Request $request
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $success = [];
        $falha = [];

        $unidade_id = $this->pessoa->unidade_id;
        $pessoa_id = $this->pessoa->id;

//        Valida os dados
        $rule = [
            "*.animal_id" => "required|integer",
            "*.vacina_tipos_id" => "required|array",
            "*.vacina_tipos_id.*" => "required|integer",
        ];
        $validate = Validator::make($request->all(), $rule);
        if ($validate->fails()) {
            throw new \Exception($validate->errors()->first());
        }

        // insere no banco
        $reqArray = $request->input();
        foreach ($reqArray as $item) {
            $ani_id = $item['animal_id'];
            $vacinas = $item['vacina_tipos_id'];
            foreach ($vacinas as $vacina_tipos_id) {
                try {
                    Vacina::create([
                        "unidade_id" => $unidade_id,
                        "pessoa_id" => $pessoa_id,
                        "animal_id" => $ani_id,
                        "vacina_tipo_id" => $vacina_tipos_id,
                        "data" => new \DateTime()
                    ]);
                    $success[] = [
                        "animal_id" => $ani_id,
                        "vacina_tipos_id" => $vacina_tipos_id
                    ];
                } catch (\Exception $e) {
                    $err = [
                        "animal_id" => $ani_id,
                        "vacina_tipos_id" => $vacina_tipos_id,
                        "message" => $e->getMessage()
                    ];
                    $falha[] = $err;
                }
            }
        }
        return response()->api(["sucesso" => $success, "falha" => $falha]);
    }

    public function historic(Request $request, $animal_id)
    {
//        $animal = $this->vacina->where("animal_id", "=", $animal_id)->with("animal")->get();
        $animais = Animal::findOrFail($animal_id)->with("vacinas")->get();
        foreach ($animais as $animal){
            foreach ($animal->vacinas as $vacina){
                $vacina_tipo_id = $vacina->vacina_tipo_id;
                $vacina_tipo_full = VacinaTipo::find($vacina_tipo_id);
                $vacina["vacina_tipo"] = $vacina_tipo_full;
            }
        }
        $data = $animais;
        return response()->api($data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function vacinaTipo(){
        $data = VacinaTipo::all();
        return response()->api($data);
    }
}
