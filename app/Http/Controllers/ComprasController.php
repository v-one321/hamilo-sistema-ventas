<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use Illuminate\Http\Request;

class ComprasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
                        //envia con datos de las relaciones
        $datos = Compras::with('proveedores', 'usuario')->paginate(10);
        return view('compras.index', compact('datos'));
    }
    public function show(string $id)
    {
        $datos = Compras::where('id', $id)->with('proveedores', 'detalle_compra', 'detalle_compra.producto')->first();
        return view('compras.view', compact('datos'));
    }
    public function destroy(string $id)
    {
        $item = Compras::find($id);
        $item->estado = !$item->estado;
        $item->save();
        return back()->with('success', 'Estado modificado');
    }
}
