<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;

class ProveedoresController extends Controller
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
        $datos = Proveedores::paginate(10);
        return view('proveedores.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proveedores.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|max:50",
            "apellido" => "max:50",
            "identificacion" => "required|max:15|unique:proveedores,identificacion",            
            "contacto" => "required|max:15",
        ]);
        $item = new Proveedores();
        $item->nombre = $request->nombre;
        if ($request->apellido != "") {
            $item->apellido = $request->apellido;            
        }
        $item->identificacion = $request->identificacion;
        $item->contacto = $request->contacto;
        $item->usuario_id = auth()->user()->id;
        if($item->save()){
            return redirect()->route('proveedores.index')->with('success', 'El registro ha sido agregado exitosamente.');
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
        $item = Proveedores::find($id);
        return view('proveedores.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nombre" => "required|max:50",
            "apellido" => "max:50",
            "identificacion" => "required|max:15|unique:proveedores,identificacion,$id"
        ]);
        $item = Proveedores::find($id);
        $item->nombre = $request->nombre;
        $item->apellido = $request->apellido;
        $item->identificacion = $request->identificacion;
        $item->contacto = $request->contacto;
        $item->usuario_id = auth()->user()->id;
        if($item->save()){
            return redirect()->route('proveedores.index')->with('success', 'El registro ha sido modificado exitosamente.');
        }else{
            return redirect()->back()->with('error', 'Error al modificar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Proveedores::find($id);
        $item->estado = !$item->estado;
        if ($item->save()) {
            return redirect()->back()->with('success', 'Estado modificado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al modificar el estado');
        }        
    }
}
