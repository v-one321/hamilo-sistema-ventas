<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $proveedores = Proveedores::when($search, function ($query) use ($search){
            $query->where('nombre', 'LIKE', '%'.$search.'%')
                    ->orWhere('apellido', 'LIKE', "%$search%")
                    ->orWhere('contacto', 'LIKE', "%$search%");
        })->with('usuario')->paginate(10);
        return response()->json(["mensaje" => "Datos cargados", "datos" => $proveedores], 200);
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
        $item->usuario_id = Auth::id();
        if ($item->save()) {
            return response()->json(["mensaje" => "Registro exitoso", "datos" => $item], 200);
        }else{
            return response()->json(["mensaje" => "No se pudo realizar el registro"], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Proveedores::find($id);
        return response()->json(["mensaje" => "Dato cargado", "datos" => $item], 200);
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
        $item->usuario_id = Auth::id();
        if ($item->save()) {
            return response()->json(["mensaje" => "Registro modificado", "datos" => $item], 201);
        }else{
            return response()->json(["mensaje" => "No se pudo realizar la modificacion"], 422);
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
            return response()->json(["mensaje" => "Estado modificado", "datos" => $item], 202);
        } else {
            return response()->json(["mensaje" => "No se pudo modificar el estado"], 422);
        }
        
    }
}
