<?php

namespace App\Http\Controllers\Trasferencia;

use App\Http\Controllers\Controller;
use App\Models\Contactos;
use App\Models\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TransferenciaController extends Controller
{
    public function index(){
        $user =Auth::user();
        $user =1;
        $usuarios= Usuarios::with('contactos.usuarios')->where('id',1)->get();
        // dd($user);
        return view('Transferencias/FormTransferencia', compact('usuarios'));
    }

   public function transferir(Request $request){
        $validator =   $this->validator($request->all(),  $user =1);

    // dd($request->all());

    }

      protected function validator(array $data,int $user)
    {

        // dd('asasas');
           return Validator::make($data, [

           ]);
    }
}
