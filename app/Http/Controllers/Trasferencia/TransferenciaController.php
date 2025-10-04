<?php

namespace App\Http\Controllers\Trasferencia;

use App\Http\Controllers\Controller;
use App\Models\Contactos;
use App\Models\Saldos;
use App\Models\Transacciones\transacciones;
use App\Models\Usuarios;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TransferenciaController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $user = 1;
        $saldo = Saldos::where('id_usuario', $user)->first()->saldo;

        $usuarios = Usuarios::with('contactos.usuarios')->where('id', $user)->get();
        // dd($user);
        return view('Transferencias/FormTransferencia', compact('usuarios', 'saldo'));
    }

    public function transferir(Request $request)
    {

        try {

            $validator =   $this->validator($request->all(),  $user = 1);
            if ($validator->fails()) {
                return response()->json(['message' => 'Existen errores para crear Centro Costo', 'data' => $validator->errors()->all()], 422);
            } else {
                $saldo_actual = Usuarios::with('saldos')->where('id', 1)->first();

                $saldo = Saldos::find($user);
                $saldo->saldo = ($saldo_actual->saldos->saldo -  str_replace(',', '.', $request->monto));
                $saldo->save();


                $trans= new transacciones();
                $trans->id_emisor = $user;
                $trans->id_receptor = $request->contacto;
                $trans->monto = str_replace(',', '.', $request->monto);
                $trans->fecha_transaccion =  Carbon::now()->format('d/m/Y');
                $trans->estado = 1;
                $trans->save();
            }
        } catch (\Exception $e) {
            Log::error('ha ocurrido un error al transferir ====> ' . $e);
            $message = 'Ha ocurrido un error al transferir!';
            $status = 422;
            return response()->json(['message' => $message, 'status' => $status], 500);
        }
        return response()->json(['message' => 'Se ha transferiro Exitosamente..!', 'redirect' => route('realizar-transferencia')], 200,);

        // dd($request->all());

    }

    protected function validator(array $data, int $user)
    {

        $saldo = Saldos::where('id_usuario', $user)->first()->saldo;
        if (isset($data['monto'])) {
            $data['monto'] = str_replace(',', '.', $data['monto']);
        }

        // dd($data);
        return Validator::make(
            $data,
            [
                'monto' => [
                    'required',
                    'regex:/^\d+(\.\d+)?$/',
                    "lte:$saldo"
                ],
            ],
            [
                "monto.required" => 'El monto no puede estar vacio.',
                "monto.regex" => 'Debe ingresar sólo números.',
                "monto.lte" => 'El monto a transferir es mayor al saldo disponible.',
            ]
        );
    }
}
