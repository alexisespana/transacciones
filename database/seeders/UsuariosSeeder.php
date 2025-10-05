<?php

namespace Database\Seeders;

use App\Models\Contactos;
use App\Models\Saldos;
use App\Models\Usuarios;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $usuario= Usuarios::get();
        foreach ($usuario as $key => $user) {
            $contact=  Usuarios::where('id','!=', $user->id)->get();
            foreach ($contact as $key => $value) {
                      
                $contactos = new Contactos();
                $contactos->id_usuario = $user->id;
                $contactos->id_contacto =$value->id;
                $contactos->estado =1;
                 $contactos->save();
            }
            # code...
        }
    }
}
