<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Detalle_ventas;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $item = Productos::when($search, function ($query) use ($search){
            $query->where('nombre', 'LIKE', '%'.$search.'%')
                    ->orWhere('codigo', 'LIKE', "%$search%");
        })->with('usuario')->paginate(10);
        return response()->json(["mensaje" => "Datos cargados", "datos" => $item], 200);
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
        $item->usuario_id = Auth::id();
        if($item->save()){
            return response()->json(["mensaje" => "Registro exitoso", "datos" => $item], 200);
        }else{
            return response()->json(["mensaje" => "Error al registrar"], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Productos::find($id);
        return response()->json(["mensaje" => "Dato cargado", "datos" => $item], 200);
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
        $item->usuario_id = Auth::id();
        if($item->save()){
            return response()->json(["mensaje" => "Registro exitoso", "datos" => $item], 201);
        }else{
            return response()->json(["mensaje" => "Error al registrar"], 422);
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
            return response()->json(["mensaje" => "Estado modificado", "datos" => $item], 202);
        } else {
            return response()->json(["mensaje" => "No se pudo modificar el estado"], 422);
        }    
    }
    public function productosActivos(Request $request)
    {
        $search = $request->get('search');
        $item = Productos::where('estado', true)->when($search, function ($query) use ($search){
            $query->where('nombre', 'LIKE', '%'.$search.'%')
                    ->orWhere('codigo', 'LIKE', "%$search%");
        })->with('usuario')->paginate(10);
        return response()->json(["mensaje" => "Datos cargados", "datos" => $item], 200);
    }
}
