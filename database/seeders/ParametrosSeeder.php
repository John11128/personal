<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ParametrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
        public function run()
{
    // Solo crea el registro si la tabla está vacía
    if (DB::table('parametros')->count() == 0) {
        DB::table('parametros')->insert([
            'id_parametro' => 1,
            'nombre_Sistema' => 'SisInvPer',
            'Administrador' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
}
