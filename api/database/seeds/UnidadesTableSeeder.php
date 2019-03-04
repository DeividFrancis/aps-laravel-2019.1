<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Facades\DB;

class UnidadesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unidades')->insert([
            'descricao' => 'Unidade Mestre',
        ]);
    }
}
