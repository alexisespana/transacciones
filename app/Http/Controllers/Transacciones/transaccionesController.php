<?php

namespace App\Http\Controllers\Transacciones;

use App\Exports\TransaccionesExport;
use App\Http\Controllers\Controller;
use App\Models\Transacciones\transacciones;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class transaccionesController extends Controller
{
    public function index()
    {

        $transacciones = transacciones::with('emisor', 'receptor')->get();

        // dd($transacciones);
        return view('Transacciones.transacciones', compact('transacciones'));
    }

    public function listarTransacciones(Request $request)
    {

        $transacciones = transacciones::with('emisor', 'receptor')->get()
            ->map(function ($transacciones, $index) {

                // dd($transacciones->estado);

                return [
                    'INDEX' => $index + 1,
                    'user_emisor' => $transacciones->emisor->nombres,
                    'user_receptor' => $transacciones->receptor->nombres,
                    'monto' =>  number_format($transacciones->monto, 2, ',', '.'),
                    'fecha' => $transacciones->fecha_transaccion,
                    'estado' => $transacciones->estado == 1 ? 'Aceptada' : 'Rechazada',
                ];
            });
        return DataTables::of($transacciones)->make(true);
    }
    public function exportarCsv()
    {
        return Excel::download(new TransaccionesExport, 'transacciones.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
