<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PessoasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("pessoas")->insert([
            "unidade_id" => 1,
            "nomerazao" => "Administrador",
            "apelidofantasia" => "Admin",
            "telefone1" => "(99)9.9999-9999",
            "telefone2" => "(88)8.8888-8888",
            "logradouro" => "LH 106 km 02 Ld sul Zona Rural, São Miguel do Guapore - RO",
            "cpfCnpj" => "123.123.123-15",
            "ie" => "12345678",
            "RG" => "12345678",
            "usuario" => "SIM",
            "senha" => Hash::make("segredo"),
            "email1" => "admin@admin.com.br",
            "email2" => "admin2@admin.com.br",
            "principal" => 1,
            "cep" => "76970-000"
        ]);
    }
}
