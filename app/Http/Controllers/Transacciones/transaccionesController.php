<?php

namespace App\Http\Controllers\Transacciones;

use App\Http\Controllers\Controller;
use App\Models\Transacciones\transacciones;
use Illuminate\Http\Request;

class transaccionesController extends Controller
{
    public function index()
    {

        $transacciones = transacciones::all();

        dd($transacciones);
        return view('Transacciones.transacciones', compact('z'));
    }
}
