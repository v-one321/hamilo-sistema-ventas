<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use Illuminate\Http\Request;

class VentasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $datos = Ventas::with('clientes', 'usuario')->paginate(10);
        return view('ventas.index', compact('datos'));
    }
    public function show(string $id)
    {
        $datos = Ventas::where('id', $id)->with('clientes', 'detalle_venta', 'detalle_venta.producto')->first();
        return view('ventas.view', compact('datos'));
    }
    public function destroy(string $id)
    {
        $item = Ventas::find($id);
        $item->estado = !$item->estado;
        $item->save();
        return back()->with('success', 'Estado modificado');
    }
}
