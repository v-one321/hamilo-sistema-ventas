<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;

class ProductosController extends Controller
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
        $datos = Productos::paginate(10);
        return view('productos.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productos.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "codigo" => "required|max:50",
            "nombre" => "required|max:50",
            "precio_compra" => "required|numeric",
            "precio_venta" => "required|numeric",
        ]);
        $item = new Productos();
        $item->nombre = $request->nombre;
        $item->codigo = $request->codigo;
        $item->descripcion = $request->descripcion;
        $item->precio_compra = $request->precio_compra;
        $item->precio_venta = $request->precio_venta;
        $item->usuario_id = auth()->user()->id;
        if($item->save()){
            return redirect()->route('productos.index')->with('success', 'El registro ha sido agregado exitosamente.');
        }else{
            return redirect()->back()->with('error', 'Error al registrar');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Productos::find($id);
        return view('productos.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "codigo" => "required|max:50",
            "nombre" => "required|max:50",
            "precio_compra" => "required|numeric",
            "precio_venta" => "required|numeric",
        ]);
        $item = Productos::find($id);
        $item->nombre = $request->nombre;
        $item->codigo = $request->codigo;
        $item->descripcion = $request->descripcion;
        $item->precio_compra = $request->precio_compra;
        $item->precio_venta = $request->precio_venta;
        $item->usuario_id = auth()->user()->id;
        if($item->save()){
            return redirect()->route('productos.index')->with('success', 'El registro ha sido modificado exitosamente.');
        }else{
            return redirect()->back()->with('error', 'Error al modificar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Productos::find($id);
        $item->estado = !$item->estado;
        if ($item->save()) {
            return redirect()->back()->with('success', 'Estado modificado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al modificar el estado');
        }        
    }
}
