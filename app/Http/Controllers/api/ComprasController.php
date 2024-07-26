<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Compras;
use App\Models\Detalle_compras;
use App\Models\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Compras::where('usuario_id', Auth::id())->with('proveedores')->paginate(10);
        return response()->json(["mensaje" => "Datos cargados", "datos" => $item], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "proveedor_id" => "required",
            "total" => "required"
        ]);
        //$datos = Detalle_compras_tempral::where('usuario_id', auth()->user()->id)->get();
        //$sumaTotal = Detalle_compras_tempral::selectRaw('SUM(total) AS suma')->where('usuario_id', auth()->user()->id)->first();
        if (count($request->detalle) != 0) {
            //Realiza transaccion sql
            try {
                DB::beginTransaction();     //Inicia PROCESOS DE LA TRANSACCION
                //          TRANSACCION
                    //  1) Crear compra
                    $item = new Compras();
                    $item->usuario_id = Auth::id();
                    $item->proveedor_id = $request->proveedor_id;
                    $item->total = $request->total;
                    $item->save();
                    //  2) Realizar la copia de la tabla temporal -> Actualizar cantidades de productos
                    foreach ($request->detalle as $value) {
                        $item2 = new Detalle_compras();
                        $item2->compra_id = $item->id;
                        $item2->producto_id = $value["producto_id"];
                        $item2->cantidad = $value["cantidad"];
                        $item2->precio_unitario = $value["precio_unitario"];
                        $item2->total = $value["precio_total"];
                        $item2->save();
                        //incrementamos cantidades
                        $item3 = Productos::find($value["producto_id"]);
                        $item3->cantidad += $value["cantidad"];
                        $item3->save();
                    }
                //          END TRANSACCION
                DB::commit();               //GUARDA TODO EN LA BASE DE DATOS
                return response()->json(["mensaje" => "Registro exitoso", "datos" => $item], 200);
            } catch (\Throwable $th) {
                DB::rollBack();             //DESHACE TODOS LOS CAMBIOS EN LA BASE DE DATOS
                return response()->json(["mensaje" => "Error: $th"], 422);
            }
        } else {
            return response()->json(["mensaje" => "La tabla carrito debe de tener productos registrados"], 422);
        }  
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Compras::where('id', $id)->with('detalle_compra', 'detalle_compra.producto')->first();
        return response()->json(["mensaje" => "Registro cargado", "datos" => $item], 200);
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
        return response()->json(["mensaje" => "Estado modificado", "datos" => $item],200);
    }
}
