<?php

namespace App\Http\Controllers;

use App\Models\Detalle_compras_tempral;
use App\Models\Productos;
use App\Models\Proveedores;
use Illuminate\Http\Request;

class DetalleComprasTemporalController extends Controller
{
    public function inicio(){
        $productos = Productos::where('estado', true)->paginate(5);
        $proveedores = Proveedores::where('estado', true)->get();
        $carrito = Detalle_compras_tempral::where('usuario_id', auth()->user()->id)->get();
        return view('compras.store', compact('productos', 'proveedores', 'carrito'));
    }
}
