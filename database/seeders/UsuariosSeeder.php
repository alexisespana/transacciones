<?php

namespace Database\Seeders;

use App\Models\Saldos;
use App\Models\Usuarios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();


        for ($i = 1; $i <=  10; $i++) {
            $usuario = DB::table('usuarios')->insertGetId([
                'nombres' =>  $faker->name,
                'email' => $faker->unique()->safeEmail,
                //    $usuario->saldo =$faker->numberBetween($min = 1000, $max = 20000);
            ]);

            $saldo = new Saldos();
            $saldo->id_usuario = $usuario;
            $saldo->saldo = $faker->numberBetween($min = 1000, $max = 20000);
            $saldo->save();
        }
    }
}
