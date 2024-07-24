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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
                        //envia con datos de las relaciones
        $datos = Compras::with('proveedores', 'usuario')->paginate(10);
        return view('compras.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $datos = Compras::where('id', $id)->with('proveedores', 'detalle_compra', 'detalle_compra.producto')->first();
        return view('compras.view', compact('datos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Compras::find($id);
        $item->estado = !$item->estado;
        $item->save();
        return back()->with('success', 'Estado modificado');
    }
}
