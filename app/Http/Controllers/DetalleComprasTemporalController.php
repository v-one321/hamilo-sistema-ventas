<?php

namespace App\Http\Controllers;

use App\Models\Compras;
use App\Models\Detalle_compras;
use App\Models\Detalle_compras_tempral;
use App\Models\Productos;
use App\Models\Proveedores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DetalleComprasTemporalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function inicio(){
        $productos = Productos::where('estado', true)->paginate(5);
        $proveedores = Proveedores::where('estado', true)->get();
        $carrito = Detalle_compras_tempral::where('usuario_id', auth()->user()->id)->get();
        $sumaTotal = Detalle_compras_tempral::selectRaw('SUM(total) AS suma')->where('usuario_id', auth()->user()->id)->first();
        return view('compras.store', compact('productos', 'proveedores', 'carrito', 'sumaTotal'));
    }
    public function agregarCarrito(string $id){
        $producto = Productos::find($id);
        if ($producto != null) {
            //pregunta si el producto se encuentra registrado en el carrito
            $existe = Detalle_compras_tempral::where('usuario_id', auth()->user()->id)->where('producto_id', $id)->first();
            if ($existe == null) {
                //añadir al carrito
                $item = new Detalle_compras_tempral();
                $item->producto_id = $id;
                $item->usuario_id = auth()->user()->id;
                $item->cantidad = 1;
                $item->precio_unitario = $producto->precio_compra;
                $item->total = $producto->precio_compra;
                $item->save();
                return back()->with('success', 'Producto añadido al carrito');
            } else {
                //solamente muestra un mensaje
                return back()->with('warning', 'El producto ya se encuentra registrado');
            }
        } else {
            //no existe el producto
            return back()->with('error', 'El producto no se encuentra registrado.');
        }
    }
    public function eliminarCarrito(string $id){
        $item = Detalle_compras_tempral::find($id);
        if ($item != null) {
            //elimina registro
            $item->delete();
            return back()->with('success', 'El producto fue eliminado del carrito.');
        } else {
            return back()->with('error', 'El producto no existe en el carrito.');
        }
    }
    public function incrementarCarrito(string $id){        
        $item = Detalle_compras_tempral::find($id);
        if ($item != null) {
            //incrementar cantidades
            $item->cantidad += 1;
            $item->total += $item->precio_unitario;
            $item->save();
            return back();
        } else {
            return back()->with('error', 'El producto no existe en el carrito.');
        } 
    }
    public function decrementarCarrito(string $id){
        $item = Detalle_compras_tempral::find($id);
        if ($item != null) {
            if($item->cantidad > 1){
                //decrementar cantidades
                $item->cantidad = $item->cantidad - 1;
                $item->total -= $item->precio_unitario;
                $item->save();
                return back();
            }else{
                //return redirect()->route('compras.eliminar-carrito', $id);
                return back()->with('warning', 'La cantidad no puede disminuir de 1.');
            }
        } else {
            return back()->with('error', 'El producto no existe en el carrito.');
        }
    }
    public function guardarCarrito(Request $request){
        $request->validate([
            "proveedor_id" => "required",
        ]);
        $datos = Detalle_compras_tempral::where('usuario_id', auth()->user()->id)->get();
        $sumaTotal = Detalle_compras_tempral::selectRaw('SUM(total) AS suma')->where('usuario_id', auth()->user()->id)->first();
        if (count($datos) != 0) {
            //Realiza transaccion sql
            try {
                DB::beginTransaction();     //Inicia PROCESOS DE LA TRANSACCION
                //          TRANSACCION
                    //  1) Crear compra
                    $item = new Compras();
                    $item->usuario_id = auth()->user()->id;
                    $item->proveedor_id = $request->proveedor_id;
                    $item->total = $sumaTotal->suma;
                    $item->save();
                    //  2) Realizar la copia de la tabla temporal -> Actualizar cantidades de productos
                    foreach ($datos as $value) {
                        $item2 = new Detalle_compras();
                        $item2->compra_id = $item->id;
                        $item2->producto_id = $value->producto_id;
                        $item2->cantidad = $value->cantidad;
                        $item2->precio_unitario = $value->precio_unitario;
                        $item2->total = $value->total;
                        $item2->save();
                        //incrementamos cantidades
                        $item3 = Productos::find($value->producto_id);
                        $item3->cantidad += $value->cantidad;
                        $item3->save();
                    }
                    //  3) Eliminar desde la tabla temporal
                    //$datos->delete();
                    Detalle_compras_tempral::where('usuario_id', auth()->user()->id)->delete();
                //          END TRANSACCION
                DB::commit();               //GUARDA TODO EN LA BASE DE DATOS
                return redirect()->route('compras.index')->with('success', 'Compra realizada correctamente');
            } catch (\Throwable $th) {
                DB::rollBack();             //DESHACE TODOS LOS CAMBIOS EN LA BASE DE DATOS
                return back()->with('error', 'Error: '.$th);
            }
        } else {
            return back()->with('error', 'La tabla carrito debe de tener productos registrados');
        }        
    }
}
