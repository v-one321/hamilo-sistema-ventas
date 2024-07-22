<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use Illuminate\Http\Request;

class ClientesController extends Controller
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
        $datos = Clientes::paginate(10);
        return view('clientes.index', compact('datos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.store');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nombre" => "required|max:50",
            "apellido" => "max:50",
            "identificacion" => "required|max:15|unique:clientes,identificacion"
        ]);
        $item = new Clientes();
        $item->nombre = $request->nombre;
        if ($request->apellido != "") {
            $item->apellido = $request->apellido;            
        }
        $item->identificacion = $request->identificacion;
        $item->usuario_id = auth()->user()->id;
        if($item->save()){
            return redirect()->route('clientes.index')->with('success', 'El registro ha sido agregado exitosamente.');
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
        $item = Clientes::find($id);
        return view('clientes.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "nombre" => "required|max:50",
            "apellido" => "max:50",
            "identificacion" => "required|max:15|unique:clientes,identificacion,$id"
        ]);
        $item = Clientes::find($id);
        $item->nombre = $request->nombre;
        $item->apellido = $request->apellido;
        $item->identificacion = $request->identificacion;
        $item->usuario_id = auth()->user()->id;
        if($item->save()){
            return redirect()->route('clientes.index')->with('success', 'El registro ha sido modificado exitosamente.');
        }else{
            return redirect()->back()->with('error', 'Error al modificar');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Clientes::find($id);
        $item->estado = !$item->estado;
        if ($item->save()) {
            return redirect()->back()->with('success', 'Estado modificado exitosamente');
        } else {
            return redirect()->back()->with('error', 'Error al modificar el estado');
        }        
    }
}
