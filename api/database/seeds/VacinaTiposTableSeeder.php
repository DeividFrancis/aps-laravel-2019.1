<?php

use Illuminate\Database\Seeder;
use App\VacinaTipo;
use App\Vacina;
class VacinaTiposTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createVacina(Vacina::AFTOSA, "Aftosa");
        $this->createVacina(Vacina::BRUCELOSE, "Brucelose");
        $this->createVacina(Vacina::CARBUNCULO, "Carbúnculo");
        $this->createVacina(Vacina::RAIVA, "Raiva");
    }

    /**
     * @param $id
     * @param $descricao
     */
    private function createVacina($id, $descricao)
    {
        $vacina = VacinaTipo::find($id);
        if($vacina == null){
            VacinaTipo::create([
                "id" => $id,
                "descricao" => $descricao
            ]);
        }else{
            $vacina->descricao = $descricao;
            $vacina->save();
        }
        $this->command->info("Vacina tipo de {$descricao} criada!");
    }
}
